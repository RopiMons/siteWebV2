<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 2/06/16
 * Time: 16:04
 */

namespace Ropi\CMSBundle\Mailer;


use RobertoTru\ToInlineStyleEmailBundle\Converter\ToInlineStyleEmailConverter;
use Ropi\CMSBundle\Parser\Parser;

class MailerCSS
{

    /**
     * @var ToInlineStyleEmailConverter
     */
    private $converter;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Parser
     */
    private $parser;

    /** @var string */
    private $rootDir;

    public function __construct(ToInlineStyleEmailConverter $converter, \Swift_Mailer $mailer, Parser $parser, $rootDir)
    {
        $this->converter = $converter;
        $this->mailer = $mailer;
        $this->parser = $parser;
        $this->rootDir = $rootDir;
    }

    /**
     * @param $template
     * @param $templateOption
     * @param $to
     * @param $subject
     * @param null $from
     * @param array|null $attachments
     * @throws \RobertoTru\ToInlineStyleEmailBundle\Converter\MissingParamException
     * @throws \RobertoTru\ToInlineStyleEmailBundle\Converter\MissingTemplatingEngineException
     */
    public function sendMail($template, $templateOption, $to, $subject, $from = null, array $attachments = null, $cc = null){

        if($from == null){
            $from = "info@ropi.be";
        }
        
        $converter = clone $this->converter; //Il faut bien dissocier les deux objets

        $converter->setHTMLByView($template,$templateOption);
        $converter->setCSS(file_get_contents($this->rootDir . '/../app/Resources/public/css/ropi.css'));

        $body = $this->parser->parse($converter->generateStyledHTML());

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setContentType("text/html")
            ->setBody($body)
            ;

        if($attachments !== null && is_array($attachments)){
            foreach ($attachments as $fileName){
                $message->attach(\Swift_Attachment::fromPath($fileName));
            }
        }

        if($cc !== null){
            $message->setCc($cc);
        }


        $this->mailer->send($message);       
        
    }
    

}