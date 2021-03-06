<?php

namespace Ropi\CMSBundle\Controller;

use Doctrine\Common\Persistence\AbstractManagerRegistry;
use Ropi\CMSBundle\Entity\Categorie;
use Ropi\CMSBundle\Entity\Page;
use Ropi\CMSBundle\Entity\PageDynamique;
use Ropi\CMSBundle\Form\CategorieType;
use Ropi\CMSBundle\Form\PageDynamiqueType;
use Ropi\CMSBundle\Map\Map;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Ropi\CMSBundle\Form\PageStatiqueForm;
use Ropi\CMSBundle\Entity\PageStatique;
use Doctrine\ORM\NoResultException;
use Ropi\CMSBundle\Entity\PositionnableInterface;

class DefaultController extends Controller {

    /**
     * @Route("/my/cms/create/static", name="CMS_static_create")
     * @Security("has_role('ROLE_CMS_CREATE') or has_role('ROLE_ADMIN')")
     * @Template()
     */
    public function createStatiqueAction(Request $request) {


        $form = $this->createForm(PageStatiqueForm::class);
        $form->add('Créer la page', SubmitType::class);


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

    private function ecrireResultat(Page $ps) {

        if(get_class($ps) == "Ropi\CMSBundle\Entity\PageStatique") {

            $nomFichier = "page_" . $ps->getId() . ".txt";
            $fp = fopen($nomFichier, "w+");
            fseek($fp, 0);
            $texte = 'array(' . $ps->getPosition() . ', "' . $ps->getTitreMenu() . '", ' . $ps->getIsActive() . ', new DateTime("' . $ps->getLastUpdate()->format(DATE_W3C) . '"), new DateTime("' . $ps->getCreatedAt()->format(DATE_W3C) . '"), new DateTime("' . $ps->getPublicationDate()->format(DATE_W3C) . '"), $this->getReference("CAT_' . $ps->getCategorie()->getPosition() . '"), "' . addslashes($ps->getContenu()) . '")';
            fputs($fp, $texte);
            fclose($fp);
        }
    }

    /**
     * @Route("/", name="home")
     * @Route("/page/{categorie}/{titreMenu}", name="cms_page")
     */
    public function getPageAction($categorie = null, $titreMenu = null) {
        if (isset($categorie) && isset($titreMenu)) {
            $repo = $this->getDoctrine()->getRepository(PageStatique::class);
            try {
                $page = $repo->getPageForCMS($categorie, $titreMenu);
                $this->verifAutorisation($page);

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
            $this->verifAutorisation($repo = $this->getDoctrine()->getRepository(PageDynamique::class)->findOneBy(array('titreMenu'=>'Accueil')));
            return $this->indexAction();
        }
    }

    private function verifAutorisation(Page $page){

        if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY') && !$page->hasPermissionString("ROLE_ANONYME")){
            //Si on est ici c'est que la page n'est pas publique


            if(!$this->getUser() || !$page->hasPermissionsString($this->getUser()->getRoles())){
                throw $this->createAccessDeniedException();
            }


        }
    }

    private function indexAction() {

        return $this->render('RopiCMSBundle:Default:index.html.twig', array(
            'pages' => $this->getDoctrine()->getRepository('Ropi\CMSBundle\Entity\PageStatique')->findAll()
        ));
    }

    /**
     * @Route("/my/cms/update/static/{id}", requirements={"id" = "\d+"}, defaults={"id" = 0}, name="CMS_update")
     */

    public function updatePageAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\Page");



        if ($id > 0) {

            $page = $repo->findOneBy(array('id' => $id));

            if ($page) {

                if(get_class($page) == "Ropi\CMSBundle\Entity\PageStatique"){

                    $newForm = PageStatiqueForm::class;
                    $nomTwig = "createStatique";

                }elseif (get_class($page) == "Ropi\CMSBundle\Entity\PageDynamique"){

                    $newForm = PageDynamiqueType::class;
                    $nomTwig = "createStatique";

                }else{
                    throw new AccessDeniedException();
                }

                $oldCategorie = $page->getCategorie();
                $form = $this->createForm($newForm, $page);
                $form->add('Modifier', SubmitType::class);

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

                return $this->render('RopiCMSBundle:Default:'.$nomTwig.'.html.twig', array(
                    'titre' => 'Modification de la page',
                    'form' => $form->createView()
                ));
            } else {
                return $this->redirect($this->generateUrl("CMS_update"));
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
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_CMS_CREATE')")
     */
    public function listAction() {
        $repo = $this->getDoctrine()->getRepository(Categorie::class);
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
     *     @Security("has_role('ROLE_ADMIN') or has_role('ROLE_CMS_CREATE')")
     */
    public function removePage($id) {
        $page = $this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\Page")->find($id);
        $this->remove($page);
        $this->clearPosition($this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\Page")->findBy(array('categorie'=>$page->getCategorie())));

        return $this->redirectToRoute("CMS_pages");
    }

    /**
     * @Route("/my/cms/categorie/remove/{id}", requirements={"id" = "\d+"}, name="CMS_categorie_remove")
     *     @Security("has_role('ROLE_ADMIN') or has_role('ROLE_CMS_CREATE')")
     */
    public function removeCategorie($id) {
        $categorie = $this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\Categorie")->find($id);
        $this->remove($categorie);
        $this->clearPosition($this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\Categorie")->findAll());

        return $this->redirectToRoute("CMS_pages");
    }

    private function remove($objet){

        if ($objet) {

            $this->getDoctrine()->getManager()->remove($objet);
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add(
                'success', 'Suppression effectuée :-)'
            );

        } else {
            throw $this->createNotFoundException();
        }
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
     * @Security( "has_role('ROLE_ADMIN') or has_role('ROLE_CMS_CREATE')")
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
     *
     * @Security( "has_role('ROLE_ADMIN') or has_role('ROLE_CMS_CREATE')")
     */
    public function moveAction($id, $sens, $type) {

        $ok = false;

        if ($type == "page") {
            $class = "Ropi\CMSBundle\Entity\Page";
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

    /**
     * @Route("/my/cms/create/categorie", name="CMS_categorie_create")
     * @Route("/my/cms/update/categorie/{id}", name="CMS_categorie_update", requirements={"id" = "\d+"})
     * @Security( "has_role('ROLE_CMS_CREATE') or has_role('ROLE_ADMIN')")
     * @Template()
     */
    public function categorieAction($id = null, Request $request) {

        if($id)
        {
            if(!$categorie = $this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\Categorie")->findOneBy(array('id'=>$id))){
                throw $this->createNotFoundException();
            }
        }else{
            $categorie = new Categorie();
        }

        $form = $this->createForm(CategorieType::class ,$categorie);

        $form->add("Enregistrer", SubmitType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager = $this->getDoctrine()->getManager();

            if(!$id){
                $position = $this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\Categorie")->getLastCategoriePosition() +1;

                $categorie = $form->getData();

                $categorie->setPosition($position);
                $categorie->setIsActive(true);

                $manager->persist($categorie);

                $this->addFlash("success","La catégorie a été rajoutée");
            }else{
                $this->addFlash("success","La catégorie a bien été modifiée");
            }

            $manager->flush();

            return $this->redirectToRoute("CMS_pages");
        }

        return array(
            'titre' => "Ajout d'une catégorie",
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/my/cms/permissions/change/{idPage}/{permissionNom}", requirements={"idPage" = "\d+"}, name="CMS_perm_change")
     * @Security(" has_role('ROLE_CMS_CREATE') or has_role('ROLE_ADMIN')")
     */
    public function inverseDroit($permissionNom, $idPage){
        $page = $this->getDoctrine()->getRepository("Ropi\CMSBundle\Entity\Page")->find($idPage);
        $permission = $this->getDoctrine()->getRepository("Ropi\AuthenticationBundle\Entity\Permission")->findOneBy(array('permission' => $permissionNom));

        if($page && $permission){
            if($page->hasPermission($permission)){
                $page->removePermission($permission);
            }else{
                $page->addPermission($permission);
            }
            $this->getDoctrine()->getManager()->flush();
        }else{
            throw $this->createNotFoundException();
        }

        return $this->redirectToRoute('CMS_pages');
    }

}
