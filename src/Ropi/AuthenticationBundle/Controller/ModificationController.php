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
     * @Route("/my/account/pwd",name="Ropi_change_pwd")
     * 
     */
     public function changePSW(Request $request) {

         $user = $this->container->get('security.context')->getToken()->getUser();
        $user2 =new IdentifiantWeb();
        $form = $this->createForm(new changePWDType(),$user2);
         $form->add("Changer le mot de passe","submit");

         $form->handleRequest($request);

         if($request->getMethod() == 'POST') {

             $old_pwd = $user2->getOldPassword();
             $new_pwd =$user2->getMotDePasse();



             $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
             $old_pwd_encoded = $encoder->encodePassword($old_pwd, $user->getSalt());


             if($user->getMotDePasse() != $old_pwd_encoded) {
                 $this->get("session")->getFlashBag()->add(

                     'danger',"Votre ancien mot de passe est mauvais!" );
                 return $this->redirect($this->generateUrl("Ropi_change_pwd"));
             } else {
                 $new_pwd_encoded = $encoder->encodePassword($new_pwd, $user->getSalt());
                 $user->setMotDePasse($new_pwd_encoded);
                 $manager = $this->getDoctrine()->getManager();
                 $manager->persist($user);

                 $manager->flush();
                 $this->get("session")->getFlashBag()->add(
                     'succes',"Mot de passe changé avec succes" );
             }




             return $this->redirect($this->generateUrl("home"));
         }


        return $this->render('RopiAuthenticationBundle:Authenticate:changeMDP.html.twig',array("form"=>$form->createView()));
    }
    

}
