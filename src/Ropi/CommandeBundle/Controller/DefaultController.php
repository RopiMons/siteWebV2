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
use Symfony\Component\OptionsResolver\Exception\AccessException;

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
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($commande);
            $commande = $form->getData();

            $statut = $manager->getRepository("Ropi\CommandeBundle\Entity\Statut")->findOneBy(array('ordre'=>1));

            if(!$statut){
                throw new AccessException();
            }

            $commande->setClient($this->getUser()->getPersonne());
            $commande->setStatut($statut);

            $mailClient = $this->getUser()->getPersonne()->getEmail();

            if(isset($mailClient)) {
                $messageClient = \Swift_Message::newInstance()
                    ->setSubject("Votre commande de Ropi")
                    ->setFrom("info@ropi.be")
                    ->setTo($mailClient)
                    ->setBody($this->renderView("RopiCommandeBundle:Default:email.newCommande.html.twig",array('commande'=>$commande)),'text/html');

                /*$messageAdmin = \Swift_Message::newInstance()
                    ->setSubject("[Ropi.Be] Nouvelle commande de Ropi")
                    ->setFrom("info@ropi.be")
                    ->setTo("info@ropi.be")
                    ->setBody(,'text/html');

                $this->get('mailer')->send($messageAdmin);*/
                $this->get('mailer')->send($messageClient);

                $this->addFlash("success","Votre commande a été enregistrée. Une confirmation vous a été envoyée à l'adresse ".$mailClient.". Merci !");

                $manager->flush();

            } else {
                $this->addFlash("danger","Aucune adresse email n'est associée à votre compte, impossible de passer la commande. Merci de prendre contact avec nous.");
            }

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
