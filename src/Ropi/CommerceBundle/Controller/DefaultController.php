<?php

namespace Ropi\CommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ropi\CommerceBundle\Form\CommerceType;
use Symfony\Component\HttpFoundation\Request;
use Ropi\CommerceBundle\Entity\Commerce;
use Ropi\IdentiteBundle\Entity\Adresse;

class DefaultController extends Controller
{
    /**
     * @Route("/my/commerce/new")
     * @Template()
     */
    public function newCommerceAction(Request $request){
        
        $adresse = new Adresse();
        $commerce = new Commerce();
        $commerce->addAdress($adresse);
        
        $form = $this->createForm(new CommerceType(),$commerce);
        $form->add("Ajouter un commerce","submit");
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            
            $commerce = $form->getData();
            $adresses = $commerce->getAdresses();
            
            foreach($adresses as $adresse){
                $adresse->setCommerce($commerce);
            }
            
            $em->persist($commerce);
            $em->flush();
        }
        
        return array(
            'form' => $form->createView(),
        );
    }
}
