<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 3/06/16
 * Time: 4:35
 */

namespace Ropi\AuthenticationBundle\Controller;


use Ropi\AuthenticationBundle\Entity\College;
use Ropi\AuthenticationBundle\Entity\Cotisation;
use Ropi\AuthenticationBundle\Entity\PaiementCot;
use Ropi\AuthenticationBundle\Form\CotisationAndPaiementType;
use Ropi\AuthenticationBundle\Form\CotisationType;
use Ropi\AuthenticationBundle\Form\PaiementCotType;
use Ropi\CommandeBundle\Entity\Paiement;
use Ropi\CommerceBundle\Entity\Commerce;
use Ropi\IdentiteBundle\Entity\Personne;
use Ropi\IdentiteBundle\Entity\TraitRepo\CotisationManagement;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class CotisationController extends Controller
{
    
    /**
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/admin/membres/cotisation/new/personne/{id}", name="admin_new_cotisation_membre")
     * @Template("RopiAuthenticationBundle:Cotisation:newCotisation.html.twig")
     */
    public function newCotisationPersonneAction(Request $request,Personne $personne){

        $college = $this->getDoctrine()->getRepository(College::class)->findOneBy(array(
            'numero' => '3'
        ));

        $retour = $this->newCotisationAction($request,$personne,$college, "Personne");

        return ($retour == "Ok") ? $this->redirectToRoute('Ropi_admin_user_listing') : $retour ;
    }

    
    /**
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/admin/membres/cotisation/new/commerce/{id}", name="admin_new_cotisation_commerce")
     * @Template("RopiAuthenticationBundle:Cotisation:newCotisation.html.twig")
     */
    public function newCotisationCommerceAction(Request $request,Commerce $commerce){

        $college = $commerce->getCollege();

        $retour = $this->newCotisationAction($request,$commerce, $college, "Commerce");

        return ($retour == "Ok") ? $this->redirectToRoute('admin_commerces') : $retour ;
    }
    
    
    private function newCotisationAction(Request $request,$cotisationManagement,College $college, $type){

        $functionName = "set".$type;

        $cotisation = new Cotisation();
        $cotisation->$functionName($cotisationManagement);

        $form = $this->createForm(CotisationType::class, $cotisation)
            ->add('Enregistrer',SubmitType::class)
        ;

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $cotisation = $form->getData();

            $cotisation->setCollege($college);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($cotisation);
            $manager->flush();

            $this->addFlash('success','La cotisation a bien été rajoutée');

            return "Ok";
        }

        return array(
            'form' => $form->createView()
        );


    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/admin/membres/paiement/add/cotisation/{id}/{route}", name="admin_add_paiement_cotisation_membre")
     * @Template("RopiAuthenticationBundle:Cotisation:newCotisation.html.twig")
     */    
    public function addPaiement(Request $request, Cotisation $cotisation, $route){

        $paiement = new PaiementCot();
        $paiement->setCotisation($cotisation);

        $form = $this->createForm(PaiementCotType::class,$paiement)
            ->add('Enregistrer',SubmitType::class)
        ;

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $paiement = $form->getData();

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($paiement);
            $manager->flush();

            $this->addFlash('success','Le paiement a bien été enregistré.');

            return $this->redirectToRoute($route);
            
        }


        return array(
            'form' => $form->createView()
        );


    }

    /**
     * @Route("/admin/commerces/paiement/add/{id}", name="admin_add_paiement_et_cotisation_commerce")
     * @Security("has_role('ROLE_ADMIN')")
     * @Template("RopiAuthenticationBundle:Cotisation:newCotisation.html.twig")
     */
    public function addPaiementAndCot(Request $request, Commerce $commerce){
        
        if($commerce->hasActifProcedurePaiement()){
            $cotisation = $commerce->getLastCotisationProcedure();
        }else{
            $cotisation = new Cotisation();
            $cotisation->setCollege($commerce->getCollege());
            $commerce->addCotisation($cotisation);
        }
        $paiement = new PaiementCot();
        $paiement->setCotisation($cotisation);
        $cotisation->addPaiement($paiement);
        $cotisation->setCommerce($commerce);
        
        $form = $this->createForm(CotisationAndPaiementType::class,$cotisation)
            ->add('Enregistrer',SubmitType::class)
            ;

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $paiements = $form->getData();

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($cotisation);

            foreach ($paiements as $paiement){
                $paiement->setCotisation($cotisation);
                $manager->persist($paiement);
            }


            $manager->flush();

            $this->addFlash('success','La cotisation de ce membre a bien été prise en compte');

            return $this->redirectToRoute('admin_commerces');

        }

        return array(
            'form' => $form->createView()
        );
    }
}