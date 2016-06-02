<?php

namespace Ropi\IdentiteBundle\Controller;

use Ropi\AuthenticationBundle\Entity\IdentifiantWeb;
use Ropi\AuthenticationBundle\Form\IdentifiantWebType;
use Ropi\IdentiteBundle\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ropi\IdentiteBundle\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Ropi\IdentiteBundle\Entity\Adresse;
use Ropi\AuthenticationBundle\Entity\KeyValidation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Ropi\IdentiteBundle\Form\PersonneAdminType;

class InscriptionController extends Controller
{
    /**
     * @Route("/inscription", name="ropi_inscription")
     * @Template()
     */
    public function inscriptionAction(Request $request)
{
    if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){
        return $this->redirect($this->generateUrl("Ropi_ok"));
    }
    $users= new IdentifiantWeb();
    $user = $users->getPersonne();

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



            }
        }
    }

    /*
     * Ajout de l'addresse
     */


    if ($user->getAdresses() === null){
        $adresse = new Adresse();

        $user->addAdress($adresse);


    }
    $form = $this->createForm(IdentifiantWebType::class, $users);
    // $form->add("Enregistrer", "submit");
    $form->add("Enregistrer",SubmitType::class);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

        $em = $this->getDoctrine()->getManager();

        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($users);
        $users->setMotDePasse($encoder->encodePassword($users->getMotDePasse(), $users->getSalt()));

        $em->persist($users);
        $em->flush();

        $cle = new KeyValidation($users->getSalt());
        $cle->setIdentifiantWeb($users->getId());
        $em->persist($cle);


        $em->flush();
        $this->MailValidation($users, $cle);

        $this->get("session")->getFlashBag()->add(
            'success',"Votre compte à bien crée, il faut maintenant validé votre addresse email!" );

        return  $this->redirect($this->generateUrl("home"));
    }
    return  Array(
        "form" => $form->createView(),
    );
}
    private function MailValidation(IdentifiantWeb $personne, KeyValidation $cle){


        $converter = $this->get('css_to_inline_email_converter');
        $converter->setHTMLByView('RopiIdentiteBundle:Inscription:mail_inscription.html.twig', array(
            'login' => $personne->getUsername(),
            'id' =>$personne->getId(),
            'cle'=>$cle->getCle(),
            'volonteMembre'=> $personne->getPersonne()->getVolonteMembre(),
            'nom' => $personne->getPersonne()->getNom(),
            'prenom' => $personne->getPersonne()->getPrenom(),
        ));
        $converter->setCSS(file_get_contents($this->container->getParameter('kernel.root_dir') . '/../app/Resources/public/css/ropi.css')); //$personne->getIdentifiantWeb()->getId()

        $body = $converter->generateStyledHTML();
        foreach ($personne->getPersonne()->getContacts() as $contact) {

            if ($contact->getTypeContact()->getType() === "Mail") {
                $message = \Swift_Message::newInstance()
                    ->setSubject("Inscription au Ropi")
                    ->setFrom("info@ropi.be")
                    ->setTo($contact->getValeur())
                    ->setContentType('text/html')
                    ->setBody($body);


                ;

                $this->get('mailer')->send($message);
            }

        }
    }

    /**
     * @Route("/admin/user/add", name="Ropi_admin_user_add")
     * @Security( "has_role('ROLE_ADMIN')")
     * @Template("RopiIdentiteBundle:Inscription:inscriptionAdmin.html.twig")
     */
    public function inscriptionAdminAction(Request $request)
    {

        $users= new Personne();
      //  $users->setIdentifiantWeb(new IdentifiantWeb());
       // $user = $users->getPersonne();

        $moyenDeContactRepo = $this->getDoctrine()->getRepository("Ropi\IdentiteBundle\Entity\TypeMoyenContact");
        $moyenDeContacts = $moyenDeContactRepo->loadForInscription();

        if(count($users->getContacts())<= 0){

            foreach ($moyenDeContacts as $i => $moyenDeContact) {
                if ($moyenDeContact->getObligatoire()) {

                    $contact = new Contact();
                    $contact->setTypeContact($moyenDeContact);
                    $contact->setPersonne($users);
                    $users->addContact($contact);
                    //$form->add(new \Ropi\IdentiteBundle\Form\ContactType($contact->getTypeContact()));

                }
            }
        }
        if ($users->getAdresses() === null){
            $adresse = new Adresse();

            $users->addAdress($adresse);
        }
        $form = $this->createForm(PersonneAdminType::class, $users);
        // $form->add("Enregistrer", "submit");
        $form->add("Enregistrer",SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $factory = $this->get('security.encoder_factory');
            foreach($users->getAdresses() as $adr )
            {
                if($adr->getVille() == null || $adr->getRue() == null){
                    $users->removeAdress($adr);
                }
            }
            foreach($users->getContacts() as $cts){
                if ($cts->getValeur() == null){

                    $users->removeContact($cts);
                }
            }
            if ($users->getIdentifiantWeb()->getUsername() == null || $users->getIdentifiantWeb()->getUsername() ==" "){
                $users->setIdentifiantWeb(null);

                $em->persist($users);
                $em->flush();

            }
            else {
                $encoder = $factory->getEncoder($users->getIdentifiantWeb());
                $users->setMotDePasse($encoder->encodePassword($users->getIdentifiantWeb()->getMotDePasse(), $users->getIdentifiantWeb()->getSalt()));
                $em->persist($users->getIdentifiantWeb());
                $em->persist($users);
                $em->flush();


            }
            return  $this->redirect($this->generateUrl("home"));
        }
        return  Array(
            "form" => $form->createView(),
        );
    }

}
