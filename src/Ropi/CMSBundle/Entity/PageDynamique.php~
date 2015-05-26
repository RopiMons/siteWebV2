<?php

namespace Ropi\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PageDynamique
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\CMSBundle\Entity\PageDynamiqueRepository")
 */
class PageDynamique extends Page
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=255)
     */
    private $route;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set route
     *
     * @param string $route
     * @return PageDynamique
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string 
     */
    public function getRoute()
    {
        return $this->route;
    }

    public function getURL() {
        return "";
    }

}
