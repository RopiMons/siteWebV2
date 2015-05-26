<?php

namespace Ropi\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
//use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Request;
use Ropi\CMSBundle\Form\PageStatiqueForm;
use Ropi\CMSBundle\Entity\PageStatique;

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
        );
    }

    private function ecrireResultat(PageStatique $ps) {
        $fp = fopen("results.txt", "w+");
        fseek($fp, -1, SEEK_END);
        $texte = 'array("' . $ps->getContenu() . '", new DateTime("' . $ps->getCreatedAt()->format(DATE_W3C) . '"), "' . $ps->getIsActive() . '", new DateTime("' . $ps->getLastUpdate()->format(DATE_W3C) . '"), "' . $ps->getPosition() . '", new DateTime("' . $ps->getPublicationDate()->format(DATE_W3C) . '"), "' . $ps->getTitreMenu() . '", $this->getReference("CAT_' . $ps->getCategorie()->getPosition() . '")),';
        fputs($fp, $texte);
        fclose($fp);
    }

}
