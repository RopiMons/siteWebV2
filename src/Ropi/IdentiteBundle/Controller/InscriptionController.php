<?php

namespace Ropi\IdentiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ropi\IdentiteBundle\Entity\Contact;
use Ropi\IdentiteBundle\Entity\Personne;
use Ropi\IdentiteBundle\Form\PersonneType;
use Ropi\IdentiteBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Ropi\IdentiteBundle\Entity\Adresse;
use Ropi\AuthenticationBundle\Entity\KeyValidation;


class InscriptionController extends Controller
{
    /**
     * @Route("/inscription", name="ropi_inscription")
     * @Template()
     */
    public function inscriptionAction(Request $request)
    {
        $user = new Personne();       
        $type = new PersonneType();
        $form = $this->createForm($type, $user);
        $moyenDeContactRepo = $this->getDoctrine()->getRepository("Ropi\IdentiteBundle\Entity\TypeMoyenContact");
        $moyenDeContacts = $moyenDeContactRepo->loadForInscription();

        foreach ($moyenDeContacts as $i => $moyenDeContact) {
            if ($moyenDeContact->getObligatoire()) {
                $contact = new Contact();
                $contact->setTypeContact($moyenDeContact);
                $contact->setPersonne($user);
                $user->addContact($contact);
                //$form->add(new \Ropi\IdentiteBundle\Form\ContactType($contact->getTypeContact()));
                dump($contact->getTypeContact());
                $form->add('contacts', "collection", array('type' => new ContactType($contact->getTypeContact())));
               
            }
        }
        
        /*
         * Ajout de l'addresse
         */
        $adresse = new Adresse();
        //$adresse->setTypeAdresse(new \Ropi\IdentiteBundle\Entity\TypeAdresse());
        $user->addAdress($adresse);
        
        $form->add('adresses','collection' ,array("type"=>new \Ropi\IdentiteBundle\Form\AdresseType()));
        
        $form->add("Enregistrer", "submit");
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
         $emCle = $this->getDoctrine()->getRepository('RopiAuthenticationBundle:KeyValidation');
         $cle = new KeyValidation($emCle,$user->getIdentifiantWeb());
            $em->persist($cle);
            $em->persist($user);

            $em->flush();
            $this->MailValidation($user);
        }
        return  Array(
                    "form" => $form->createView(),
        );
    }
    private function MailValidation(Personne $personne){
        $converter = $this->get('css_to_inline_email_converter');
        $converter->setHTMLByView('RopiIdentiteBundle:Inscription:mail_inscription.html.twig', array('login' => $personne->getIdentifiantWeb()->getUsername(), 'url' => "home"));
        $converter->setCSS(file_get_contents($this->container->getParameter('kernel.root_dir') . '/../app/Resources/public/css/ropi.css'));
        
        $body = $converter->generateStyledHTML();
         foreach ($personne->getContacts() as $contact) {
             dump($contact->getTypeContact()->getType());
            if ($contact->getTypeContact()->getType() === "Mail") {
                $message = \Swift_Message::newInstance()
                        ->setSubject("Inscription au Ropi")
                        ->setFrom("adrien.huygens@gmail.com")
                        ->setTo($contact->getValeur())
                        ->setBody($body)
                ;
              
                $this->get('mailer')->send($message);
            }
    }
    }
}
