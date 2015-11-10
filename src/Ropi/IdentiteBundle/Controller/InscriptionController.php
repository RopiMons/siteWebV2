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
           
         
        
        if(count($user->getContacts())<= 0){
             
        foreach ($moyenDeContacts as $i => $moyenDeContact) {
            if ($moyenDeContact->getObligatoire()) {
               
                $contact = new Contact();
                $contact->setTypeContact($moyenDeContact);
                $contact->setPersonne($user);
                $user->addContact($contact);
                //$form->add(new \Ropi\IdentiteBundle\Form\ContactType($contact->getTypeContact()));

                $form->add('contacts', "collection", array('type' => new ContactType($contact->getTypeContact())));
               
            }
        }
        }
        /*
         * Ajout de l'addresse
         */
        if ($user->getAdresses() === null){
        $adresse = new Adresse();
        //$adresse->setTypeAdresse(new \Ropi\IdentiteBundle\Entity\TypeAdresse());
        $user->addAdress($adresse);
        
        $form->add('adresses','collection' ,array("type"=>new \Ropi\IdentiteBundle\Form\AdresseType()));
        }
       // $form->add("Enregistrer", "submit");
        $form->add("Enregistrer","submit");
     $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {




            $em = $this->getDoctrine()->getManager();

         $emCle = $this->getDoctrine()->getRepository('RopiAuthenticationBundle:KeyValidation');
         $cle = new KeyValidation($emCle,$user->getIdentifiantWeb());
            
         $factory = $this->get('security.encoder_factory');
         $encoder = $factory->getEncoder($user->getIdentifiantWeb());
          $user->getIdentifiantWeb()->setMotDePasse($encoder->encodePassword($user->getIdentifiantWeb()->getMotDePasse(), $user->getIdentifiantWeb()->getSalt()));
         
         $em->persist($cle);
            $em->persist($user);

           $em->flush();
            $this->MailValidation($user, $cle);
            $validationMail = true;
            $this->get("session")->getFlashBag()->add(
                'success',"Votre compte à bien crée, il faut maintenant validé votre addresse email!" );
            if ($validationMail) {
                $this->get("session")->getFlashBag()->add(
                    'info', "L'option est temporeraiment désactivé, connexion impossible, merci de votre compréhension!");
            }
          //  return $this->redirect($this->generateUrl("home"));
        }
        return  Array(
                    "form" => $form->createView(),
        );
    }
    private function MailValidation(Personne $personne, KeyValidation $cle){


       $converter = $this->get('css_to_inline_email_converter');
        $converter->setHTMLByView('RopiIdentiteBundle:Inscription:mail_inscription.html.twig', array('login' => $personne->getIdentifiantWeb()->getUsername(),
                        'id' =>$personne->getIdentifiantWeb()->getId(),'cle'=>$cle->getCle()));
        $converter->setCSS(file_get_contents($this->container->getParameter('kernel.root_dir') . '/../app/Resources/public/css/ropi.css')); //$personne->getIdentifiantWeb()->getId()

        $body = $converter->generateStyledHTML();
         foreach ($personne->getContacts() as $contact) {

            if ($contact->getTypeContact()->getType() === "Mail") {
                $message = \Swift_Message::newInstance()
                        ->setSubject("Inscription au Ropi")
                        ->setFrom("info@ropi.be")
                        ->setTo($contact->getValeur())
                        ->setBody($body);

                ;

                $this->get('mailer')->send($message);
            }
    }
    }
}
