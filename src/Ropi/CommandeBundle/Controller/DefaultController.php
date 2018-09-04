<?php

namespace Ropi\CommandeBundle\Controller;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Ropi\CMSBundle\Mailer\MailerCSS;
use Ropi\CommandeBundle\Entity\ArticleCommande;
use Ropi\CommandeBundle\Entity\Commande;
use Ropi\CommandeBundle\Entity\ModeDeLivraison;
use Ropi\CommandeBundle\Entity\Paiement;
use Ropi\CommandeBundle\Entity\Statut;
use Ropi\CommandeBundle\Form\CommandeClientType;
use Ropi\CommandeBundle\Form\PaiementType;
use Ropi\CommerceBundle\Entity\Commerce;
use Ropi\IdentiteBundle\Entity\Adresse;
use Ropi\IdentiteBundle\Form\AdresseType;
use function Sodium\add;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security;

class DefaultController extends Controller
{
    private $cacheDir;

    function __construct($cacheDir)
    {
        $this->cacheDir = $cacheDir;
    }

    /**
     * @param Commande $commande
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/admin/commande/{commande}/restaure", name="admin_restaure_commande", requirements={"commande":"\d+"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function restaureCommande(Commande $commande){
        $commande->setArchive(false);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($commande);
        $manager->flush();

        $this->addFlash("success","La commande a bien été restaurée !");

        return $this->redirectToRoute("admin_commandes_archive_view");
    }

    /**
     * @param Commande $commande
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/admin/commande/{commande}/archive", name="admin_archive_commande", requirements={"commande":"\d+"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function archiveCommande(Commande $commande){
        $commande->setArchive(true);

        if($commande->getStatut()->getOrdre() == 5){
            $nextStatut = $this->getDoctrine()->getRepository(Statut::class)->findOneBy(array(
                'ordre' => $commande->getStatut()->getOrdre() + 1
            ));
            $commande->setStatut($nextStatut);
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($commande);
        $manager->flush();

        $this->addFlash("success","La commande a bien été archivée !");

        return $this->redirectToRoute("admin_commandes_view");
    }

    /**
     * @param Commande $commande
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/admin/commande/remove/{commande}", name="admin_commande_delete", requirements={"commande":"\d+"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteCommande(Commande $commande){

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($commande);
        $manager->flush();

        $this->addFlash("success","La commande a bien été supprimée");
        return $this->redirectToRoute("admin_commandes_view");
    }

    /**
     * @param Commande $commande
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/admin/commande/confirm/reception/{commande}", name="admin_commande_reception", requirements={"commande":"\d+"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function receptionOk(Commande $commande){

        $nextStatut = $this->getDoctrine()->getRepository(Statut::class)->findOneBy(array(
            'ordre' => $commande->getStatut()->getOrdre() + 1
        ));
        $commande->setStatut($nextStatut);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($commande);
        $manager->flush();

        $this->addFlash("success","Excelent ! C'est noté :-)");

        return $this->redirectToRoute("admin_commandes_view");
    }

    /**
     * @param Commande $commande
     * @param MailerCSS $mailer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \RobertoTru\ToInlineStyleEmailBundle\Converter\MissingParamException
     * @throws \RobertoTru\ToInlineStyleEmailBundle\Converter\MissingTemplatingEngineException
     * @Route("/admin/commande/{commande}/livraison/pending", name="admin_commande_livraison", requirements={"commande":"\d+"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function goLivraison(Commande $commande, MailerCSS $mailer){
        $mailer->sendMail("RopiCommandeBundle:Default:email_livraison_ok.html.twig",
            array('commande' => $commande),
        $commande->getClient()->getEmail(),
        "[Ropi.be] Livraison de vos ROPI"
            );

        $nextStatut = $this->getDoctrine()->getRepository(Statut::class)->findOneBy(array(
            'ordre' => $commande->getStatut()->getOrdre() + 1
        ));
        $commande->setStatut($nextStatut);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($commande);
        $manager->flush();

        $this->addFlash("success","Excelent ! Le client a été prévenu");

        return $this->redirectToRoute("admin_commandes_view");
    }

    /**
     * @param Commande $commande
     * @Route("/admin/pdf/facture/commande/{commande}", name="admin_pdf_facture_commande", requirements={"commande":"\d+"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function getFacture(Commande $commande, Pdf $pdf){

        return $this->render("RopiCommandeBundle:Default:facture_commande.html.twig",array(
            'commande' => $commande
        ));


        return new PdfResponse(


            $pdf->getOutputFromHtml($this->renderView("RopiCommandeBundle:Default:facture_commande.html.twig",array(
                'commande' => $commande
            )),
                array(
                    'orientation' => 'portrait',
                    'page-size' => "A4",
                    'encoding' => 'utf-8',
                    'margin-top' => 0,
                    'margin-bottom' => 0,
                    'margin-left' => 0,
                    'margin-right' => 0,
                    'dpi' => 300
                )),
            'NoteDeFrais_'.$commande->getRefCommande().'.pdf'

        );


    }

    /**
     * @param Commande $commande
     * @param Pdf $pdf
     * @return PdfResponse
     * @Route("/admin/commande/{commande}/pdf/signature", name="admin_commande_signature", requirements={"commande":"\d+"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function getSignature(Commande $commande, Pdf $pdf){

        return new PdfResponse(
            $pdf->getOutputFromHtml($this->renderView("RopiCommandeBundle:Default:signature_commande.html.twig",array(
                'commande' => $commande
            )),
                array(
                    'orientation' => 'portrait',
                    'page-size' => "A4",
                    'encoding' => 'utf-8',
                    'margin-top' => 0,
                    'margin-bottom' => 0,
                    'margin-left' => 0,
                    'margin-right' => 0,
                    'dpi' => 300
                )),
            'Signature_'.$commande->getRefCommande().'.pdf'
        );


    }

    /**
     * @Route("/admin/commandes/view", name="admin_commandes_view")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function adminViewCommande(){
        $commandes = $this->getDoctrine()->getRepository(Commande::class)->getAll();

        return $this->render("RopiCommandeBundle:Default:admin_commandes_view.html.twig",array(
            'commandes' => $commandes
        ));
    }


    /**
     * @Route("/admin/commandes/archive/view", name="admin_commandes_archive_view")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function adminViewCommandeArchive(){
        $commandes = $this->getDoctrine()->getRepository(Commande::class)->getAll(true);

        return $this->render("RopiCommandeBundle:Default:admin_commandes_view.html.twig",array(
            'commandes' => $commandes
        ));
    }




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

        $mailer = $this->get('mailer');
        $mailer->send($mailClient);
        $mailer->send($mailAdmin);


    }


    /**
     * @Route("/my/commande/livraison/{choixLivraison}", name="commande_ajax_livraison", condition="request.isXmlHttpRequest()", options={"expose"=true})
     * @Security( "has_role('ROLE_UTILISATEUR_ACTIVE')")
     */
    public function livraisonManagement($choixLivraison){

        $manager = $this->getDoctrine()->getManager();

        switch($choixLivraison){
            case "commercant" : return new JsonResponse($this->renderView('RopiCommandeBundle:Default:_livraisonCommercant.html.twig',array('commerces' => $manager->getRepository(Commerce::class)->findBy(array('depot'=>true,'visible'=>true,'valide'=>true)),'modeDeLivraison' => $manager->getRepository(ModeDeLivraison::class)->findOneBy(array('nom'=>'Dépôt chez un commerçant')))));
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
        $solde = $this->getDoctrine()->getRepository(Commande::class)->getNbRopi();

        return array('solde'=>$solde);
    }

    /**
     * @param Request $request
     * @param Commande $commande
     * @param MailerCSS $mailer
     * @param Pdf $pdf
     * @param string $cacheDir
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \RobertoTru\ToInlineStyleEmailBundle\Converter\MissingParamException
     * @throws \RobertoTru\ToInlineStyleEmailBundle\Converter\MissingTemplatingEngineException
     * @Route("/admin/commande/{commande}/paiement/add", name="admin_add_paiement", requirements={"commande":"\d+"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addPaiement(Request $request, Commande $commande, MailerCSS $mailer, Pdf $pdf){

        $form = $this->createForm(PaiementType::class);
        $form->add("Ajouter",SubmitType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var Paiement $paiement */
            $paiement = $form->getData();

            $commande->addPaiement($paiement);
            $paiement->setCommande($commande);

            if($commande->getSolde() == 0){
                $nextStatut = $this->getDoctrine()->getRepository(Statut::class)->findOneBy(array(
                    'ordre' => $commande->getStatut()->getOrdre() + 1
                ));

                $this->sendPDFPaiementOk($commande,$mailer,$pdf);
                $commande->setStatut($nextStatut);
            }

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($commande);
            $manager->persist($paiement);

            $manager->flush();

            $this->addFlash('success','Le paiement a bien été enregistré');

            return $this->redirectToRoute("admin_commandes_view");
        }

        return $this->render(
            "RopiCommandeBundle:Default:add_paiement.html.twig",
            array(
                "form" => $form->createView()
            )
        );
    }


    /**
     * @param Commande $commande
     * @param MailerCSS $mailer
     * @param Pdf $pdf
     * @throws \RobertoTru\ToInlineStyleEmailBundle\Converter\MissingParamException
     * @throws \RobertoTru\ToInlineStyleEmailBundle\Converter\MissingTemplatingEngineException
     */
    private function sendPDFPaiementOk(Commande $commande, MailerCSS $mailer, Pdf $pdf){

        $attachements = array();



        /** Génération de la facture */
        $fileName = $this->cacheDir."/pdf/noteDeFrais_".$commande->getRefCommande().".pdf";

        $pdf->generateFromHtml(
            $this->renderView("RopiCommandeBundle:Default:facture_commande.html.twig",array(
                'commande' => $commande
            )),
            $fileName,
            array(
                'orientation' => 'portrait',
                'page-size' => "A4",
                'encoding' => 'utf-8',
                'margin-top' => 0,
                'margin-bottom' => 0,
                'margin-left' => 0,
                'margin-right' => 0,
                'dpi' => 300
            ),
            true);

        $attachements[] = $fileName;

        /** Génération du document d'acceptation si nécessaire */

        if($commande->getAdresseDeLivraison()->getCommerce() !== null){

            $fileName = $this->cacheDir."/pdf/signature_".$commande->getRefCommande().".pdf";

            $pdf->generateFromHtml(
                $this->renderView("RopiCommandeBundle:Default:signature_commande.html.twig",array(
                    'commande' => $commande
                )),
                $fileName,
                array(
                    'orientation' => 'portrait',
                    'page-size' => "A4",
                    'encoding' => 'utf-8',
                    'margin-top' => 0,
                    'margin-bottom' => 0,
                    'margin-left' => 0,
                    'margin-right' => 0,
                    'dpi' => 300
                ),
                true);

            $attachements[] = $fileName;
        }


        $mailer->sendMail(
            'RopiCommandeBundle:Default:email_paiement_ok.html.twig',
            array(
                'commande' => $commande
            ),
            $commande->getClient()->getEmail(),
            "[ROPI] Paiement reçus",
            null,
            $attachements,
            "laurent.cardon@ropi.be"
        );

        foreach ($attachements as $fileName){
            unlink($fileName);
        }

    }



}
