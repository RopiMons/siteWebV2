<?php

namespace Ropi\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ropi\AuthenticationBundle\Entity\IdentifiantWeb;
use Ropi\AuthenticationBundle\Form\IdentifiantWebType;
use Symfony\Component\HttpFoundation\Request;
use Ropi\AuthenticationBundle\Entity\Role;
use Ropi\AuthenticationBundle\Form\RoleType;
use Ropi\IdentiteBundle\Entity\Contact;
use Ropi\IdentiteBundle\Entity\TypeMoyenContact;
use Ropi\IdentiteBundle\Form\ContactType;

class DefaultController extends Controller {

    /**
     * @Route("/test/form")
     * @Template()
     */
    public function indexAction(Request $request) {
        //$user = new IdentifiantWeb();
        $user = new \Ropi\IdentiteBundle\Entity\Personne();
        $contact1 = new Contact();
        $type1 = new TypeMoyenContact();
        $type1->setType("coucou");
        $contact1->setTypeContact($type1);
        $user->addContact($contact1);
        $type = new \Ropi\IdentiteBundle\Form\PersonneType();
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
                $form->add("submit", "submit");
            }
        }






        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            //$factory = $this->get('security.encoder_factory');
            //$encoder = $factory->getEncoder($user);
            //$user->setMotDePasse($encoder->encodePassword($user->getMotDePasse(), $user->getSalt()));
            //$em = $this->getDoctrine()->getRepository('RopiAuthenticationBundle:KeyValidation');
            //$cle = new KeyValidation($em,$user);           


            $em = $this->getDoctrine()->getManager();
            //$em->persist($cle);
            $em->persist($user);

            $em->flush();
        }
        return $this->render('RopiTestBundle:formulaire:form.html.twig', Array(
                    "form" => $form->createView(),
        ));
    }

    /**
     * @Route("/test/role/{id}")
     * @Template()
     */
    public function roleAction(Request $request, Role $id = null) {
        dump($id);
        if ($id === null)
            $role = new Role();
        else
            $role = $id;
        $form = $this->createForm(new RoleType(), $role);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($role);
            $em->flush();
        }
        return $this->render('RopiTestBundle:formulaire:form.html.twig', Array(
                    "form" => $form->createView(),
        ));
    }

    /**
     * @Route("/bonjour")
     */
    public function testAction() {
        $personne = new \Ropi\IdentiteBundle\Entity\Personne();

        $contactsObligatoires = $this->getDoctrine()->getRepository("Ropi\IdentiteBundle\Entity\TypeMoyenContact")->loadForInscription();

        foreach ($contactsObligatoires as $moyenDeContact) {
            $temp = new Contact();
            $temp->setTypeContact($moyenDeContact);
            $temp->setPersonne($personne);
            $personne->addContact($temp);
        }

        $form = $this->createForm(new \Ropi\IdentiteBundle\Form\PersonneType(), $personne);

        return $this->render("RopiTestBundle:formulaire:form.html.twig", array(
                    'form' => $form->createView(),
        ));
    }

}
