<?php

namespace Ropi\AuthenticationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Ropi\AuthenticationBundle\Entity\KeyValidation;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Ropi\AuthenticationBundle\Entity\IdentifiantWeb;

class AuthenticateController extends Controller
{
    
    /**
     * @Route("/login")
     * 
     */
   public function loginAction() {
        $request = $this->getRequest();
        $session = $request->getSession();
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('RopiAuthenticationBundle:Authenticate:login.html.twig', array(
                    // last username entered by the user
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error' => $error,
        ));
    }
    /**
     * @Route("/my/",name="Ropi_ok")
     * 
     */
     public function okAction() {
        
        $notification = array();
        $em = $this->getDoctrine()->getManager();

        $this->getUser()->setLastConnection(new \DateTime());
        $em->persist($this->getUser());
        $em->flush();
        
         /*
          * Gestion des notifications
          * il faut juste crée une vue notification et passer un tableau avec la vue et les parametre de la vue.
          */
        
        return $this->render("RopiAuthenticationBundle:Authenticate:ok.html.twig");
    }
    
    /**
     * @Route("/confirmation/{id}/{key}",name="Ropi_Key")
     * 
     */
     public function testKeyAction(Request $request,$key,IdentifiantWeb $id) {
        
        if ($key != null && $id != null){
           
            
            $em = $this->getDoctrine()->getRepository('RopiAuthenticationBundle:KeyValidation');
            $validation = $em->findBy(array("cle"=>$key));
            
           if(isset($validation) && $validation[0]->getIdentifiantWeb() === $id){
       
               if($validation[0]->getValidation()->modify('+2 day') >= new \DateTime())
               {
                 
                   $id->setActif(true);
                   $em = $this->getDoctrine()->getManager();
                    $em->persist($id);
                    $em->flush();
                    
                    $em->remove($validation[0]);
                    $em->flush();
           
                        
                   $this->get("session")->getFlashBag(array(
                       'success'=>"Votre compte à bien été validé" ));
               }
               else{
                   $this->get("session")->getFlashBag(array(
                       'error'=>"Votre clé de validation n'est plus valide" ));
               }
               
           }
           else{
               $this->get("session")->getFlashBag(array(
                       'error'=>"Votre clé de validation à déjà été utilisé ou n'existe pas" ));
               }
            }
        
        
         /*
          * Gestion des notifications
          * il faut juste crée une vue notification et passer un tableau avec la vue et les parametre de la vue.
          */
        
        return $this->redirect($this->generateUrl("home"));
    }
    

}
