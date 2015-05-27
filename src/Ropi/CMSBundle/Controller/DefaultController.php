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
use Ropi\CMSBundle\Entity\PositionnableInterface;

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

            $em->flush();


            $this->ecrireResultat($page);

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
        $texte = 'array(' . $ps->getPosition() . ', "' . $ps->getTitreMenu() . '", ' . $ps->getIsActive() . ', new DateTime("' . $ps->getLastUpdate()->format(DATE_W3C) . '"), new DateTime("' . $ps->getCreatedAt()->format(DATE_W3C) . '"), new DateTime("' . $ps->getPublicationDate()->format(DATE_W3C) . '"), $this->getReference("CAT_' . $ps->getCategorie()->getPosition() . '"), "' . addslashes($ps->getContenu()) . '")';
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
            try {
                $page = $repo->getPageForCMS($categorie, $titreMenu);
            } catch (NoResultException $ex) {
                $page = null;
            }

            if ($page) {
                return $this->render('RopiCMSBundle:Default:cmsStatique.html.twig', array(
                            'page' => $page,
                ));
            } else {
                throw $this->createNotFoundException("Cette page n'a pas été trouvée");
            }
        } else {
            return $this->indexAction();
        }
    }

    private function indexAction() {
        return $this->render('RopiCMSBundle:Default:index.html.twig', array(
                    'pages' => $this->getDoctrine()->getRepository('Ropi\CMSBundle\Entity\PageStatique')->findAll(),
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
                $oldCategorie = $page->getCategorie();
                $form = $this->createForm(new PageStatiqueForm(), $page);
                $form->add('Modifier', 'submit');
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {

                    $page = $form->getData();
                    $chg = $oldCategorie->getId() != $page->getCategorie()->getId();

                    if($chg) {
                        $catRepo = $this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\Categorie");
                        $page->setPosition($catRepo->getLastPosition($page->getCategorie()->getId()) + 1);
                        }

                    $this->ecrireResultat($page);
                    $em->persist($page);
                    $em->flush();
                    
                    if($chg)
                    {
                        $this->clearPosition($this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\Page")->findBy(array('categorie'=>$oldCategorie)));
                    }
                                        
                    $this->get('session')->getFlashBag()->add(
                            'success', 'Modification réalisée avec succès !'
                    );
                    return $this->redirect($this->generateUrl("CMS_pages"));
                }

                return $this->render('RopiCMSBundle:Default:createStatique.html.twig', array(
                            'titre' => 'Modification de la page',
                            'form' => $form->createView()
                ));
            } else {
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

    /**
     * @Route("/my/cms/pages", name="CMS_pages")
     * @Template()
     */
    public function listAction() {
        $repo = $this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\Categorie");
        $tab = $repo->getAllOrderedPage();

        usort($tab, function($a, $b) {
            return $this->comparePosition($a, $b);
        });
        return array(
            'categories' => $tab,
        );
    }

    /**
     * @Route("/my/cms/page/remove/{id}", requirements={"id" = "\d+"}, name="CMS_page_remove")
     */
    public function removePage($id) {
        $page = $this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\PageStatique")->find($id);
        if ($page) {
            $this->getDoctrine()->getManager()->remove($page);
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', 'La page a bien été supprimée'
            );

            $this->clearPosition($this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\Page")->findBy(array('categorie' => $page->getCategorie())));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'danger', 'La page n\'a pas été trouvée, elle n\'est donc pas supprimée'
            );
        }

        return $this->redirect($this->generateUrl('CMS_pages'));
    }

    private function clearPosition($tab) {

        $i = 1;
        usort($tab, function($a, $b) {
            return $this->comparePosition($a, $b);
        });

        foreach ($tab as $element) {
            $element->setPosition($i);
            $i++;
        }
        $this->getDoctrine()->getManager()->flush();
    }

    private function comparePosition(PositionnableInterface $a, PositionnableInterface $b) {
        if ($a->getPosition() == $b->getPosition()) {
            return 0;
        }

        return ($a->getPosition() < $b->getPosition()) ? -1 : 1;
    }

    /**
     * @Route("/my/cms/page/active/{id}", requirements={"id" = "\d+"}, name="CMS_page_inverse" )
     * 
     */
    public function inversedActive($id) {
        $page = $this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\PageStatique")->findOneBy(array('id' => $id));

        $page = $this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\PageStatique")->findOneBy(array('id' => $id));
        if ($page) {
            $page->setIsActive(!$page->getIsActive());
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirect($this->generateUrl("CMS_pages"));
    }

    /**
     * @Route("/my/cms/page/up/{id}", requirements={"id" = "\d+"}, defaults={"sens" = -1, "type"="page"}, name="CMS_pages_up")
     * @Route("/my/cms/page/down/{id}", requirements={"id" = "\d+"}, defaults={"sens" = 1, "type"="page"}, name="CMS_pages_down")
     * 
     * @Route("/my/cms/categorie/up/{id}", requirements={"id" = "\d+"}, defaults={"sens" = -1, "type"="categorie"}, name="CMS_categories_up")
     * @Route("/my/cms/categorie/down/{id}", requirements={"id" = "\d+"}, defaults={"sens" = 1, "type"="categorie"}, name="CMS_categories_down")
     */
    public function moveAction($id, $sens, $type) {

        $ok = false;

        if ($type == "page") {
            $class = "Ropi\CMSBundle\Entity\PageStatique";
        } else {
            $class = "Ropi\CMSBundle\Entity\Categorie";
        }

        $repo = $this->getDoctrine()->getRepository($class);
        $element1 = $repo->findOneBy(array('id' => $id));


        if ($element1) {

            $position = $element1->getPosition();
            $newPosition = $position + $sens;

            if ($type == "page") {
                $conditions = array(
                    'position' => $newPosition,
                    'categorie' => $element1->getCategorie()
                );
            } else {
                $conditions = array(
                    'position' => $newPosition
                );
            }

            $element2 = $repo->findOneBy($conditions);
            if ($element2) {
                $element1->setPosition($newPosition);
                $element2->setPosition($position);

                $this->getDoctrine()->getManager()->flush();

                $ok = true;
            }
        }

        if (!$ok) {
            $this->get('session')->getFlashBag()->add('danger', 'La modification n\'a pas été effectuée');
        }

        return $this->redirect($this->generateUrl("CMS_pages"));
    }

}
