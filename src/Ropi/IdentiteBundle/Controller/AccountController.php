<?php

namespace Ropi\IdentiteBundle\Controller;

use Ropi\IdentiteBundle\Form\PersonneModifType;
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



class AccountController extends Controller
{
    /**
     * @Route("/my/account/", name="ropi_account")
     * @Template()
     */
    public function accountAction(Request $request)
    {

        $user = $this->container->get('security.context')->getToken()->getUser();


        return array('user'=> $user->getPersonne()) ;
    }


    /**
     * @Route("/my/account/modification/", name="Ropi_account_modification")
     * @Template()
     */
public function modifAccountAction(Request $request){
    $user = $this->container->get('security.context')->getToken()->getUser();
    $personne = $user->getPersonne();
    $type = new PersonneModifType();
    $form = $this->createForm($type, $personne);


    $form->add("Enregistrer","submit");
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $em = $this->getDoctrine()->getManager();



        $em->persist($personne);

        $em->flush();
        //$this->MailValidation($user, $cle);
        $this->get("session")->getFlashBag(array(
            'success'=>"Votre compte à bien été modifié!" ));
        return $this->redirect($this->generateUrl("home"));
    }
    return  Array(
        "form" => $form->createView(),"user"=>$user
    );

}

}
