<?php

namespace Ropi\CommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ropi\CommerceBundle\Form\CommerceType;
use Symfony\Component\HttpFoundation\Request;
use Ropi\CommerceBundle\Entity\Commerce;
use Ropi\IdentiteBundle\Entity\Adresse;
use JMS\SecurityExtraBundle\Annotation\Secure;

class DefaultController extends Controller {

    /**
     * @Route("/my/commerce/new")
     * @Template()
     */
    public function newCommerceAction(Request $request) {

        $form = $this->createCommercantForm($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $commerce = $form->getData();
//$commerce->addPersonne($this->getUser()->getPersonne());
            $adresses = $commerce->getAdresses();

            foreach ($adresses as $adresse) {
                $adresse->setCommerce($commerce);
            }


            $em->persist($commerce);
            $em->flush();
        }

        return array(
            'form' => $form->createView(),
        );
    }

    private function createCommercantForm(Request $request, Commerce $commerce = null) {
        if (!$commerce) {
            $adresse = new Adresse();
            $commerce = new Commerce();
            $commerce->addAdress($adresse);
        }

        $form = $this->createForm(new CommerceType(), $commerce);
        $form->add("Ajouter un commerce", "submit");

        $form->handleRequest($request);

        return $form;
    }

    /**
     * @Secure(roles={"ROLE_ADMIN"})
     * 
     * @Route("/my/commerce/validate/{id}", requirements={"id": "\d+"}, defaults={"id": null}, name="commerce_validate")
     * @Template()
     */
    public function validateAction($id = null) {
        $repo = $this->getDoctrine()->getRepository("Ropi\CommerceBundle\Entity\Commerce");

        if (isset($id)) {
            $commercant = $repo->findOneBy(array('id' => $id));

            if ($commercant) {
                $commercant->setActive(true);
                $this->getDoctrine()->getManager()->flush();
            }

            $this->get('session')->getFlashBag()->add('success', 'Le commerce ' . $commercant->getNom() . ' a bien été validé');

            $this->redirect($this->generateUrl("commerce_validate"));
        } else {
            return array(
                'commerces' => $repo->findBy(array('visible' => false)),
            );
        }
    }

    /**
     * @Route("/my/commerce/update/{id}", name="commerce_update")
     * @Secure("ROLE_ADMIN")
     * @Template()
     */
    public function updateAction(Request $request, $id) {
        $commerce = $this->getDoctrine()->getRepository("Ropi\CommerceBundle\Entity\Commerce")->find($id);

        if ($commerce) {
            $form = $this->createCommercantForm($request, $commerce);

            if ($form->isSubmitted() && $form->isValid()) {

                $this->getDoctrine()->getManager()->flush();

                $this->get('session')->getFlashBag()->add('success', 'Modifications prisent en compte');

                $this->redirect($this->generateUrl("commerce_home"));
            }

            return $this->render("RopiCommerceBundle:Default:newCommerce.html.twig", array(
                        'form' => $form->createView(),
            ));
            
        } else {
            throw $this->createNotFoundException();
        }
    }

}
