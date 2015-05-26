<?php

namespace Ropi\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
//use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Request;
use Ropi\CMSBundle\Form\PageStatiqueForm;
use Ropi\CMSBundle\Entity\PageStatique;
use Doctrine\ORM\NoResultException;

class DefaultController extends Controller {

    /**
     * @Route("/my/cms/create/static", name="CMS_static_create")
     * Secure(roles="ROLE_CMS_CREATE")
     * @Template()
     */
    public function createStatiqueAction(Request $request) {


        $form = $this->createForm(new PageStatiqueForm());
        $form->add('Créer la page', 'submit');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $catRepo = $this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\Categorie");

            $page = $form->getData();
            $page->setPosition($catRepo->getLastPosition($page->getCategorie()->getId()) + 1);

            $em->persist($page);

            $this->ecrireResultat($page);

            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', 'La page a bien été créée !'
            );

            return $this->redirect($this->generateUrl("CMS_static_create"));
        }

        return array(
            'form' => $form->createView(),
            'titre' => 'Créer une nouvelle page'
        );
    }

    private function ecrireResultat(PageStatique $ps) {
        $nomFichier = "page_" . $ps->getId() . ".txt";
        $fp = fopen($nomFichier, "w+");
        fseek($fp, 0);
        $texte = 'array(' . $ps->getPosition() . ', "' . $ps->getTitreMenu() . '", ' . $ps->getIsActive() . ', new DateTime("' . $ps->getLastUpdate()->format(DATE_W3C) . '"), new DateTime("' . $ps->getCreatedAt()->format(DATE_W3C) . '"), new DateTime("' . $ps->getPublicationDate()->format(DATE_W3C) . '"), $this->getReference("CAT_' . $ps->getCategorie()->getPosition() . '"), "' . $ps->getContenu() . '")';
        fputs($fp, $texte);
        fclose($fp);
    }

    /**
     * @Route("/", name="home")
     * @Route("/page/{categorie}/{titreMenu}", name="cms_page")
     */
    public function getPageAction($categorie = null, $titreMenu = null) {
        if (isset($categorie) && isset($titreMenu)) {
            $repo = $this->getDoctrine()->getRepository('Ropi\CMSBundle\Entity\PageStatique');
            try{
                $page = $repo->getPageForCMS($categorie, $titreMenu);
            } catch (NoResultException $ex) {
                $page = null;
            }
            
            if($page){
                return $this->render('RopiCMSBundle:Default:cmsStatique.html.twig',array(
                    'page' => $page,
                ));
            }else {
                throw $this->createNotFoundException("Cette page n'a pas été trouvée");
            }
            
        } else {
            return $this->indexAction();
        }
    }

    private function indexAction() {
        return $this->render('RopiCMSBundle:Default:index.html.twig',array(
            'pages'=>$this->getDoctrine()->getRepository('Ropi\CMSBundle\Entity\PageStatique')->findAll(),
        ));
    }

    /**
     * @Route("/my/cms/update/static/{id}", requirements={"id" = "\d+"}, defaults={"id" = 0}, name="CMS_static_update")
     */
    public function updatePageAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\PageStatique");
        if ($id > 0) {

            $page = $repo->findOneBy(array('id' => $id));
            if ($page) {
                $form = $this->createForm(new PageStatiqueForm(), $page);
                $form->add('Modifier', 'submit');
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $this->ecrireResultat($form->getData());
                    $em->flush();
                    $this->get('session')->getFlashBag()->add(
                            'success', 'Modification réalisée avec succès !'
                    );
                    return $this->redirect($this->generateUrl("CMS_static_update"));
                }
                
                return $this->render('RopiCMSBundle:Default:createStatique.html.twig', array(
                    'titre' => 'Modification de la page',
                    'form' => $form->createView()
                ));
                
            }else{
                return $this->redirect($this->generateUrl("CMS_static_update"));
            }

            
        } else {
            $pages = $repo->findAll();

            return $this->render("RopiCMSBundle:Default:listeA.html.twig", array(
                        'liste' => $pages,
                        'titre' => "Sélection de la page à modifier",
            ));
        }
    }

}
