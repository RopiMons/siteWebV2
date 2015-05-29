<?php

/*
 * Copyright 2015 Version 1.0.0
 * Pour le Pass, projet gestion de log.
 * @author Huygens Adrien
 * contact adrien.huygens@gmail.com
 */

namespace Ropi\CMSBundle\Menu;

use Doctrine\ORM\EntityManager;
use Knp\Menu\FactoryInterface;
use Ropi\CMSBundle\Entity\PositionnableInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Ropi\CMSBundle\Menu\AbstractMenu;

class Builder extends AbstractMenu {

    /**
     * @param FactoryInterface $factory
     */
    /* public function __construct(FactoryInterface $factory)
      {
      $this->factory = $factory;
      } */

    protected function tableau() {
        $listeCategories = $this->em->getRepository('RopiCMSBundle:Categorie')->loadPages($this->permissions);

        usort($listeCategories, function($a, $b) {
            return $this->comparePosition($a, $b);
        });
        
        
        $tab = array();
        foreach ($listeCategories as $categorie) {
            $pages = $categorie->getPages();
            $temp = array();

            $unique = count($pages) == 1;

            foreach ($pages as $page) {

                $contenu = $page->getURIArray();

                if ($unique) {
                    $tab[$page->getTitreMenu()] = $contenu;
                } else {
                    $temp[$page->getTitreMenu()] = $contenu;
                }
            }

            if (!$unique) {
                $tab[$categorie->getNom()] = $temp;
            }
        }

        return $tab;
    }

    private function comparePosition(PositionnableInterface $a, PositionnableInterface $b) {
        if ($a->getPosition() == $b->getPosition()) {
            return 0;
        }

        return ($a->getPosition() < $b->getPosition()) ? -1 : 1;
    }

}
