<?php

namespace Ropi\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PageStatique
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\CMSBundle\Repository\PageStatiqueRepository")
 */
class PageStatique extends Page {
    
    private $route = "cms_page"; //Route vers les pages du CMS statique

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     * @Assert\NotBlank()
     * 
     */
    private $contenu;

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return PageStatique
     */
    public function setContenu($contenu) {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     * 
     */
    public function getContenu() {
        return $this->contenu;
    }
    
    public function getRoute(){
        return $this->route;
    }
    
    public function getParametres(){
        return array(
                'categorie' => $this->getCategorie()->getNom(),
                'titreMenu' => $this->getTitreMenu()
            );
    }

    public function getURIArray() {
        return array(
            'route' => $this->getRoute(),
            'routeParameters' => $this->getParametres()
        );
    }

}
