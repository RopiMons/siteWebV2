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
use Ropi\AuthenticationBundle\Entity\KeyValidation;

class DefaultController extends Controller
{
    /**
     * @Route("/test/form")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $user = new IdentifiantWeb();
        
         $form = $this->createForm(new IdentifiantWebType(),$user );
        
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
           
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
           
            $user->setMotDePasse($encoder->encodePassword($user->getMotDePasse(), $user->getSalt()));
           
            
            $em = $this->getDoctrine()->getRepository('RopiAuthenticationBundle:KeyValidation');
            $cle = new KeyValidation($em,$user);           
            
           
            $em = $this->getDoctrine()->getManager();
            $em->persist($cle);
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
    public function roleAction(Request $request,Role $id = null)
    {
        dump($id);
        if ($id === null)
        $role = new Role();
        else $role = $id;
         $form = $this->createForm(new RoleType(),$role );
        
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
}
