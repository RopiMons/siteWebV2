<?php

namespace Ropi\AuthenticationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\Security\Core\SecurityContext;

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
     * @Route("/my",name="Ropi_ok")
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

}
