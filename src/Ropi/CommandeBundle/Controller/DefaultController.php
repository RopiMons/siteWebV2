<?php

namespace Ropi\CommandeBundle\Controller;

use Ropi\CommandeBundle\Entity\ArticleCommande;
use Ropi\CommandeBundle\Entity\Commande;
use Ropi\CommandeBundle\Form\CommandeClientType;
use Ropi\CommandeBundle\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        $articles = $this->getDoctrine()->getRepository("Ropi\CommandeBundle\Entity\Article")->findBy(array('actif'=>true));

        foreach($articles as $article){
            $ac = new ArticleCommande();
            $ac->setCommande($commande);
            $ac->setArticle($article);
            $ac->setQuantite(0);

            $commande->addArticlesQuantite($ac);
        }

        $form = $this->createForm($formType,$commande);

        $form->add("send","submit",array('label'=>'Je commande mes Ropis'));

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

        }

        dump((string) $form->getErrors(true));

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/my/commande/livraison/{idLivraison}", requirements= { "idLivraison" = "\d+"}, name="commande_ajax_livraison", condition="request.isXmlHttpRequest()", options={"expose"=true})
     * @Secure(roles={"ROLE_UTILISATEUR_ACTIVE"})
     */
    public function livraisonManagement($idLivraison){

        $livraison = $this->getDoctrine()->getRepository("Ropi\CommandeBundle\Entity\ModeDeLivraison")->find($idLivraison);

        if($livraison){

            return new JsonResponse($livraison->getFrais()." €");


        }else{
            return new JsonResponse();
        }
    }

}
