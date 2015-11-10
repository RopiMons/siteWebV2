<?php

namespace Ropi\CommandeBundle\Controller;

use Ropi\CommandeBundle\Entity\Commande;
use Ropi\CommandeBundle\Form\CommandeClientType;
use Ropi\CommandeBundle\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use JMS\SecurityExtraBundle\Annotation\Secure;

class DefaultController extends Controller
{

    /**
     * @Route("/my/commande/new", name="commande_new")
     * @Template()
     * @Secure(roles={"ROLE_UTILISATEUR_ACTIVE"})
     */
    public function newCommandeAction(Request $request){
        $commande = new Commande();
        $formType = new CommandeClientType();

        $form = $this->createForm($formType,$commande);

        $form->add("Je commande mes Ropis","submit");

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

        }

        return array(
            'form' => $form->createView(),
        );
    }

}
