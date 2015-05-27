<?php

namespace Ropi\CommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/my/commerce/new")
     * @Template()
     */
    public function newCommerceAction(){
        $form = $this->createForm($type);
        
        return array(
            'form' => $form->createView(),
        );
    }
}
