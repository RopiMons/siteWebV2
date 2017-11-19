<?php

namespace Ropi\CommerceBundle\Controller;

use Ropi\CommerceBundle\Datatables\CommerceDatatable;
use Ropi\IdentiteBundle\Entity\Personne;
use Ropi\IdentiteBundle\Entity\TypeAdresse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Ropi\CommerceBundle\Entity\Commerce;
use Ropi\CommerceBundle\Form\CommerceAdminType;
use Ropi\CommerceBundle\Form\CommerceType;
use Ropi\IdentiteBundle\Entity\Adresse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller {

    private $route = "admin_home"; //Route de redirection par défaut après une action

    /**
     * @Security("has_role('ROLE_UTILISATEUR_ACTIVE') or has_role('ROLE_COMMERCANT')")
     * @Route("/my/commerce/new",name="commerce_new")
     * @Template()
     */

    public function newCommerceAction(Request $request) {

        $form = $this->createCommercantForm($request,null,true);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $repoAT = $this->getDoctrine()->getRepository("Ropi\IdentiteBundle\Entity\TypeAdresse");
            $at = $repoAT->findOneBy(array('valeur'=>'Adresse du commerce'));

            /** @var Commerce $commerce */
            $commerce = $form->getData();

            if(!$this->isGranted('ROLE_ADMIN')){
                $personne = $this->getUser()->getPersonne();
                $commerce->addPersonne($personne);
            }

            $commerce->setVisible(false);
            $commerce->setDepot(false);

            $adresses = $commerce->getAdresses();

            foreach ($adresses as $adresse) {
                $adresse->setCommerce($commerce);
                $adresse->setTypeAdresse($at);
            }

            $em->persist($commerce);
            $em->flush();

            $this->addFlash('success', 'Votre commerce nous a bien été proposé. Vous serez recontacté dès que possible.');

            foreach ($commerce->getPersonnes() as $personne ) {
                $this->sendMailValidationCommerce($personne->getContacts(), $commerce, $personne);
            }



            return $this->redirect($this->generateUrl("Ropi_ok"));
        }

        return array(
            'form' => $form->createView(),
        );
    }

    private function createCommercantForm(Request $request, Commerce $commerce = null, $admin = false) {
        if (!$commerce) {

            $adresse = new Adresse();
            $type = $this->getDoctrine()->getRepository(TypeAdresse::class)->findOneBy(array('valeur'=>'Adresse du commerce'));
            $adresse->setTypeAdresse($type);
            $commerce = new Commerce();
            $commerce->addAdress($adresse);
        }

        if($admin && $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            $form = $this->createForm(CommerceAdminType::class, $commerce);
        }else{
            $form = $this->createForm(CommerceType::class, $commerce);
        }

        $form->add("Ajouter un commerce", SubmitType::class);

        $form->handleRequest($request);

        return $form;
    }

    /**
     * @Security(" has_role('ROLE_ADMIN')")
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
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_COMMERCANT')")
     * @Template()
     */
    public function updateAction(Request $request, $id, $route = null) {
        $commerce = $this->getDoctrine()->getRepository("Ropi\CommerceBundle\Entity\Commerce")->find($id);

        $this->denyAccessUnlessGranted('edit',$commerce);

        if ($commerce) {
            $form = $this->createCommercantForm($request, $commerce, true);

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
     * @Security( "has_role('ROLE_ADMIN')")
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
     * @Security( "has_role('ROLE_ADMIN')")
     * @Route("/my/admin/commerces", name="admin_commerces")
     * @Template()
     */
    public function indexAction() {
        $repo = $this->getDoctrine()->getRepository("Ropi\CommerceBundle\Entity\Commerce");
        $commerces = $repo->getValideCommerces();



        return array(
            'commerces' => $commerces,
            'route' => 'admin_commerces'
        );
    }

    /**
     *
     * @Route("/my/commerce/{proprety}/{id}/{route}", requirements={"id": "\d+"}, name="commerce_change")
     * @Security( "has_role('ROLE_ADMIN')")
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
     * @Route("/map", name="qr_code_map")
     * @Route("/commerce/{nom}", name="commerce_view")
     *
     * @Template()
     *
     */
    public function commercesAction(Request $request, $nom = null) {
        $repo = $this->getDoctrine()->getRepository("Ropi\CommerceBundle\Entity\Commerce");

        if (isset($nom)) {

            $commerce = $repo->findOneBy(array(
                'nom' => $nom,
                'visible' => true,
                'valide' => true
            ));

            if ($commerce && $commerce->getVisible()) {

                return $this->render("RopiCommerceBundle:Default:commerceView.html.twig",array(
                    'commerce'=>$commerce,
                ));
            }else{
                $this->addFlash("danger", "Ce commerce n'existe pas ou n'est pas activé");
                return $this->redirectToRoute("commerce_index");
            }
        }

       return $this->redirectToRoute("commerce_index");


    }

    public function sendMailValidationCommerce($adresseCommercant, Commerce $commerce, Personne $personne){

        $mailer = $this->get("ropi.cms.mailer");

        foreach ($adresseCommercant as $contact){
            if($contact->getTypeContact()== "Mail"){
                $mailer->sendMail("RopiCommerceBundle:Mail:_confirmationCommercant.html.twig",array('commerce'=>$commerce),$contact->getValeur(),"[Ropi.Be] confirmation de création de commerce");
            }
        }

        $mailer->sendMail("RopiCommerceBundle:Mail:_notificationEquipe.html.twig",array('commerce'=>$commerce,'personne'=>$personne),"info@ropi.be","[Ropi.Be/admin] confirmation de création de commerce ");



    }

    /**
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_COMMERCANT')")
     * @Route("/my/mesCommerces", name="commerces_my")
     * @Template("RopiCommerceBundle:Default:listingsModifs.html.twig")
     */
    public function myCommercesAction(){

        $commerces = $this->getDoctrine()->getRepository(Commerce::class)->getMyCommerces($this->getUser()->getPersonne());

        return array(
            'commerces' => $commerces
        );

    }

    /**
     * @Template("RopiCommerceBundle:Default:simple.html.twig")
     */
    public function getNbCommercantAction(){

        $commerces = $this->getDoctrine()->getRepository(Commerce::class)->findBy(array(
            'visible' => true,
            'valide' => true
        ));


        $nb = 0;

        /*foreach ($commerces as $commerce){
            if($commerce->getVisible()){
                $nb ++;
            }
        }*/

        return array(
            'nb' => sizeof($commerces)
        );
    }


    /**
     * Lists all Post entities.
     *
     * @param Request $request
     *
     * @Route("/commercants", name="commerce_index")
     * @Method("GET")
     *
     * @return Response
     */
    public function commerceIndexAction(Request $request)
    {
        $isAjax = $request->isXmlHttpRequest();

        // Get your Datatable ...
        $datatable = $this->get('app.datatable.commerces');
        $datatable->buildDatatable();



        if ($isAjax) {
            $responseService = $this->get('sg_datatables.response');
            $responseService->setDatatable($datatable);

            $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();

            /** @var QueryBuilder $qb */
            $qb = $datatableQueryBuilder->getQb()
                ->where("commerce.valide = :true")
                ->andWhere("commerce.visible = :true")
                ->setParameter("true",true);

            return $responseService->getResponse();

        }

        return $this->render('RopiCommerceBundle:Default:commerces.html.twig', array(
            'datatable' => $datatable,
        ));
    }

    /**
     * Finds and displays a Post entity.
     *
     * @param Post $post
     *
     * @Route("/commerces/{id}", name = "commerce_show", options = {"expose" = true})
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     *
     * @return Response
     */
    public function showAction(Commerce $commerce)
    {
        return $this->render('post/show.html.twig', array(
            'commerce' => $commerce
        ));
    }

}
