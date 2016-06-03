<?php

namespace Ropi\CommandeBundle\Controller;

use Ropi\CommandeBundle\Entity\ArticleCommande;
use Ropi\CommandeBundle\Entity\Commande;
use Ropi\CommandeBundle\Form\CommandeClientType;
use Ropi\CommandeBundle\Form\CommandePaiementType;
use Ropi\CommandeBundle\Form\CommandeType;
use Ropi\CommerceBundle\Entity\Commerce;
use Ropi\IdentiteBundle\Entity\Adresse;
use Ropi\IdentiteBundle\Form\AdresseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\OptionsResolver\Exception\AccessException;

class DefaultController extends Controller
{

    /**
     * @Route("/my/commande/new", name="commande_new")
     * @Template()
     * @Security( "has_role('ROLE_UTILISATEUR_ACTIVE')")
     */
    public function newCommandeAction(Request $request){
        $commande = new Commande();

        $articles = $this->getDoctrine()->getRepository("Ropi\CommandeBundle\Entity\Article")->findBy(array('actif'=>true));

        foreach($articles as $article){
            $ac = new ArticleCommande();
            $ac->setCommande($commande);
            $ac->setArticle($article);
            $ac->setQuantite(0);

            $commande->addArticlesQuantite($ac);
        }

        $form = $this->createForm(CommandeClientType::class,$commande);

        $form->add("send",SubmitType::class,array('label'=>'Je commande mes Ropis'));

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($commande);
            $commande = $form->getData();

            $statut = $manager->getRepository("Ropi\CommandeBundle\Entity\Statut")->findOneBy(array('ordre'=>1));

            if(!$statut){
                throw new AccessException();
            }


            $commande->setStatut($statut);
            $commande->setClient($this->getUser()->getPersonne());


            $manager->flush();

            $commande->calcRefCommande();

            $manager->flush();

            return $this->redirectToRoute("commande_new_paiement",array('idCommande' => $commande->getId()));

        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/my/commande/new/paiement/{idCommande}", name="commande_new_paiement", requirements={ "idCommande" = "\d+" } )
     * @Template()
     * @Security( "has_role('ROLE_UTILISATEUR_ACTIVE')")
     */
    public function addMoyenDePaiementAction($idCommande, Request $request){

        $manager = $this->getDoctrine()->getManager();

        $commande = $manager->getRepository("Ropi\CommandeBundle\Entity\Commande")->find($idCommande);

        if($commande && $commande->getClient() == $this->getUser()->getPersonne() && $commande->getStatut()->getOrdre() == 1){

            $lolo = $request->get('moyenDePaiement');

                if($lolo && ($mdp = $manager->getRepository("Ropi\CommandeBundle\Entity\ModeDePaiement")->find($lolo)) && ($newStatut = $manager->getRepository("Ropi\CommandeBundle\Entity\Statut")->findOneBy(array('ordre'=>2)))){

                    $commande->setModeDePaiement($mdp);
                    $commande->setStatut($newStatut);

                    $manager->flush();

                    $this->sendMails($commande);

                    if($mdp->getRedirection() != null){
                        //A implémenter
                    }else{
                        return $this->render('RopiCommandeBundle:Default:confirmationCommande.html.twig',array('commande'=>$commande));
                    }

                }

                $mdp = $manager->getRepository("Ropi\CommandeBundle\Entity\ModeDePaiement")->findBy(array(
                    'actif' => true
                ));

                $tab = array();
                $montant = $commande->getPrix();

                foreach($mdp as $mode){
                    $mode->setMontant($montant);
                    $tab[] = $mode;
                }

                return array(
                    'commande'=> $commande,
                    'mdp' => $tab
                );





        }else{
            throw $this->createAccessDeniedException();
        }
    }

    private function sendMails(Commande $commande){

        $mailClient = \Swift_Message::newInstance()
            ->addTo($commande->getClient()->getEmail())
            ->addFrom("info@ropi.be")
            ->setSubject("Votre commande en ligne")
            ->setBody($this->renderView("RopiCommandeBundle:Default:email.newCommande.html.twig",array('commande'=>$commande)),'text/html')
            ;

        $mailAdmin  = \Swift_Message::newInstance()
            ->addTo("info@ropi.be")
            ->addFrom("info@ropi.be")
            ->setSubject("[Ropi.Be] Nouvelle commande")
            ->setBody($this->renderView("RopiCommandeBundle:Default:email.admin.newCommande.html.twig",array('commande'=>$commande)),'text/html')
        ;

        $this->get('mailer')->send($mailClient);
        $this->get('mailer')->send($mailAdmin);


    }


    /**
     * @Route("/my/commande/livraison/{choixLivraison}", name="commande_ajax_livraison", condition="request.isXmlHttpRequest()", options={"expose"=true})
     * @Security( "has_role('ROLE_UTILISATEUR_ACTIVE')")
     */
    public function livraisonManagement($choixLivraison){

        $manager = $this->getDoctrine()->getManager();

        switch($choixLivraison){
            case "commercant" : return new JsonResponse($this->renderView('RopiCommandeBundle:Default:_livraisonCommerçant.html.twig',array('commerces' => $manager->getRepository("Ropi\CommerceBundle\Entity\Commerce")->findBy(array('depot'=>true,'visible'=>true,'valide'=>true)),'modeDeLivraison' => $manager->getRepository("Ropi\CommandeBundle\Entity\ModeDeLivraison")->findOneBy(array('nom'=>'Chez un commercant')))));
            case "moi" : return new JsonResponse($this->renderView('RopiCommandeBundle:Default:_livraisonADomicile.html.twig',array('adresses' => $this->getUser()->getPersonne()->getAdresses())));
            default : $test = null;
        }


    }

    /**
     * @Route("/my/commande/livraison/adresse/{idAdresse}", requirements = { "idAdresse" = "\d+" }, name="commande_ajax_modeDeLivraison", condition="request.isXmlHttpRequest()", options={"expose"=true})
     * @Security( "has_role('ROLE_UTILISATEUR_ACTIVE')")
     */
    public function livraisonAdresse($idAdresse){

        $manager = $this->getDoctrine()->getManager();

        $adresse = $manager->getRepository("Ropi\IdentiteBundle\Entity\Adresse")->getAdresse($idAdresse, $this->getUser()->getPersonne());

        if($adresse){
            $codePostal = intval($adresse->getVille()->getCodePostal());

            $modes = $manager->getRepository("Ropi\CommandeBundle\Entity\ModeDeLivraison")->findBy(array(
                'aDomicile' => true,
                'actif' => true,
            ));

            $tab = array();

            foreach($modes as $mode){
                if(preg_match($mode->getRegleCP(),$codePostal)){
                    $tab[] = $mode;
                }
            }

            return new JsonResponse($this->renderView('RopiCommandeBundle:Default:_modeLivraisonADomicile.html.twig',array('modes'=>$tab)));


        }

        return new JsonResponse();


    }

    /**
     * @Route("my/commande/livraison/adresse/add", name="commande_ajax_addAdresse", condition="request.isXmlHttpRequest()", options={"expose"=true})
     */
    public function addAdresse(Request $request){
        $adresse = new Adresse();
        $adresse->addPersonne($this->getUser()->getPersonne());

        $form = $this->createForm(AdresseType::class, $adresse);

        $form->add('Ajouter cette adresse',SubmitType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $data = $form->getData();

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($data);
            $manager->flush();

            return $this->getMyAdresses();

        }
        return new JsonResponse($this->renderView('RopiCommandeBundle:Default:_addAdresse.html.twig',array('form'=>$form->createView())));
    }

    /**
     * @Route("my/commande/livraison/adresses/my", name="commande_ajax_myAdresses", condition="request.isXmlHttpRequest()", options={"expose"=true})
     */
    public function getMyAdresses(){
        $adresses = $this->getDoctrine()->getManager()->getRepository("Ropi\IdentiteBundle\Entity\Adresse")->getAdresses($this->getUser()->getPersonne());

        return new JsonResponse($this->renderView("RopiCommandeBundle:Default:_myAdressesChoices.html.twig",array('adresses'=>$adresses)));
    }

    /** @Template("RopiCommandeBundle:Default:simple.html.twig") */
    public function getNbRopiCommandeAction(){
        $commandes = $this->getDoctrine()->getRepository(Commande::class)->findAll();

        $solde = 0;
        
        foreach ($commandes as $commande){
            foreach ($commande->getArticles() as $ac) {
                $solde += $ac->getQuantite() * $ac->getArticle()->getPrix();
            }
        }

        return array('solde'=>$solde);
    }



}
