<?php

namespace Ropi\CommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Ropi\CommerceBundle\Entity\Etiquette;
use Ropi\CommerceBundle\Form\EtiquetteType;


class EtiquetteController extends Controller {

    /**
     * @Route("/my/admin/commerce/etiquette/create")
     * @Template()
     */
    public function newEtiquetteAction(Request $request) {
    
        $etiquette = new Etiquette();
        $form = $this->createForm(new EtiquetteType() , $etiquette);
        
        $form->handleRequest($request);
        if($form->isValid()){
             $em = $this->getDoctrine()->getManager();
             
            $em->persist($etiquette);
            $em->flush();
        }

    
    return array('formulaire'=>$form->createView());
       
    }
}