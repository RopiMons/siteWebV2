<?php

namespace Ropi\CommerceBundle\Controller;

use JMS\SecurityExtraBundle\Annotation\Secure;
use Ropi\CommerceBundle\Entity\Commerce;
use Ropi\CommerceBundle\Form\CommerceType;
use Ropi\IdentiteBundle\Entity\Adresse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class DefaultController extends Controller {

    private $route = "admin_home"; //Route de redirection par défaut après une action

    /**
     * @Secure(roles={"ROLE_UTILISATEUR_ACTIVE","ROLE_COMMERCANT"})
     * @Route("/my/commerce/new",name="commerce_new")
     * @Template()
     */

    public function newCommerceAction(Request $request) {

        $form = $this->createCommercantForm($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $repoAT = $this->getDoctrine()->getRepository("Ropi\IdentiteBundle\Entity\TypeAdresse");
            $at = $repoAT->findOneBy(array('valeur'=>'Adresse du commerce'));

            $commerce = $form->getData();
            $commerce->addPersonne($this->getUser()->getPersonne());
            $commerce->setVisible(false);
            $commerce->setDepot(false);

            $adresses = $commerce->getAdresses();

            foreach ($adresses as $adresse) {
                $adresse->setCommerce($commerce);
                $adresse->setTypeAdresse($at);
            }

            $em->persist($commerce);
            $em->flush();
            
            $this->addFlash('success', 'Votre commerce nous a bien été proposé. Vous serez recontacté dès que possible');
            return $this->redirect($this->generateUrl("Ropi_ok"));
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
                
                $commercant->setValide(true);
                  
            
                $this->getDoctrine()->getManager()->flush();
            }

            $this->get('session')->getFlashBag()->add('success', 'Le commerce ' . $commercant->getNom() . ' a bien été validé');
        }

        return array(
            'commerces' => $repo->findBy(array('valide' => false)),
        );
    }

    /**
     * @Route("/my/commerce/update/{id}/{route}", requirements={"id": "\d+"}, defaults={"route": null}, name="commerce_update")
     * @Secure("ROLE_ADMIN")
     * @Template()
     */
    public function updateAction(Request $request, $id, $route = null) {
        $commerce = $this->getDoctrine()->getRepository("Ropi\CommerceBundle\Entity\Commerce")->find($id);

        if ($commerce) {
            $form = $this->createCommercantForm($request, $commerce);

            if ($form->isSubmitted() && $form->isValid()) {

                $this->getDoctrine()->getManager()->flush();

                $this->get('session')->getFlashBag()->add('success', 'Modifications prisent en compte');

                return $this->gestionRoute($route);
            }

            return $this->render("RopiCommerceBundle:Default:newCommerce.html.twig", array(
                        'form' => $form->createView(),
            ));
        } else {
            throw $this->createNotFoundException();
        }
    }

    /**
     * @Secure(roles={"ROLE_ADMIN"})
     * 
     * @Route("/my/commerce/remove/{id}/{route}", requirements={"id": "\d+"}, defaults={"route": null}, name="commerce_remove")
     * 
     */
    public function removeAction($id, $route = null) {
        $repo = $this->getDoctrine()->getRepository("Ropi\CommerceBundle\Entity\Commerce");
        $commerce = $repo->find($id);
        if ($commerce) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commerce);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Le commerce a bien été supprimé');
        }

        return $this->gestionRoute($route);
    }

    /**
     * @Secure(roles={"ROLE_ADMIN"})
     * @Route("/my/admin/commerces", name="admin_commerces")
     * @Template()
     */
    public function indexAction() {
        $repo = $this->getDoctrine()->getRepository("Ropi\CommerceBundle\Entity\Commerce");
        $commerces = $repo->findBy(array('valide' => true));

        return array(
            'commerces' => $commerces,
            'route' => 'admin_commerces'
        );
    }

    /**
     * 
     * @Route("/my/commerce/{proprety}/{id}/{route}", requirements={"id": "\d+"}, name="commerce_change")
     * @Secure(roles={"ROLE_ADMIN"})
     * 
     * Attention, très dangeureux d'ouvrir vers l'extérieure ... La généricité ...
     */
    public function changeProprety($proprety, $id, $route = null) {
        $repo = $this->getDoctrine()->getRepository('Ropi\CommerceBundle\Entity\Commerce');
        $em = $this->getDoctrine()->getManager();
        $commerce = $repo->find($id);
        if ($commerce) {
            $proprety = ucfirst($proprety);
            $get = "get" . $proprety;
            $set = "set" . $proprety;
            $commerce->$set(!$commerce->$get());
            $em->flush();

            $this->addFlash('success', 'La modification a bien été réalisée');
        } else {
            $this->addFlash('danger', 'Le modification a échouée');
        }

        return $this->gestionRoute($route);
    }

    private function gestionRoute($route) {
        if (isset($route)) {

            try {
                $route = $this->generateUrl($route);
            } catch (RouteNotFoundException $ex) {
                $route = $this->generateUrl($this->route);
            }
        } else {
            $route = $this->generateUrl($this->route);
        }

        return $this->redirect($route);
    }

    /**
     * 
     * @Route("/commerces", name="commerces")
     * @Route("/commerce/{nom}", name="commerce_view")
     * 
     * @Template()
     * 
     */
    public function commercesAction($nom = null) {
        $repo = $this->getDoctrine()->getRepository("Ropi\CommerceBundle\Entity\Commerce");

        if (isset($nom)) {

            $commerce = $repo->findOneBy(array(
                'nom' => $nom,
                'visible' => true,
                'valide' => true
            ));

            if ($commerce) {
                return $this->render("RopiCommerceBundle:Default:commerceView.html.twig",array(
                    'commerce'=>$commerce,
                ));
            }else{
                $this->addFlash("danger", "Ce commerce n'existe pas ou n'est pas activé");
            }
        } 
            
            $commerces = $repo->findBy(array(
                'visible'=>true,
                'valide'=>true
            ));
            
            return array('commerces'=>$commerces);
            
        
    }

}
