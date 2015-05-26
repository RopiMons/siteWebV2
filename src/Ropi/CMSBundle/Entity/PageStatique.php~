<?php

namespace Ropi\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PageStatique
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\CMSBundle\Entity\PageStatiqueRepository")
 */
class PageStatique extends Page
{
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
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     * 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    public function getURL() {
        return "";
    }

}
