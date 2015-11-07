<?php

namespace Ropi\AuthenticationBundle\Controller;

use Ropi\AuthenticationBundle\Form\changePWDType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Ropi\AuthenticationBundle\Entity\IdentifiantWeb;

class ModificationController extends Controller
{
    

    
    /**
     * @Route("/my/account/psw",name="Ropi_change_pwd")
     * 
     */
     public function changePSW(Request $request) {

         $user = $this->container->get('security.context')->getToken()->getUser();
        $form = $this->createForm(new changePWDType(),$user );
         $form->add("Changer le mot de passe","submit");

         $form->handleRequest($request);

         if($form->isValid() && $form->isSubmitted()){
             $factory = $this->get('security.encoder_factory');
             $encorder = $factory->getEncoder($user);

             $user->setMotDePasse($encorder->encodePassword($user->getMotDePasse(),$user->getSalt()));

             $em= $this->getDoctrine()->getManager();
             $em->persist($user);
             $em->flush();
             $this->get("session")->getFlashBag(array(
                 'success'=>"Votre mot de passe à bien été modifié!" ));
             return $this->redirect($this->generateUrl("home"));
         }


        return $this->render('RopiAuthenticationBundle:Authenticate:changeMDP.html.twig',array("form"=>$form->createView()));
    }
    

}
