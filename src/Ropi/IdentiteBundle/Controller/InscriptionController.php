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


class InscriptionController extends Controller
{
    /**
     * @Route("/inscription")
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
                $form->add("submit", "submit");
            }
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);

            $em->flush();
        }
        return  Array(
                    "form" => $form->createView(),
        );
    }
}
