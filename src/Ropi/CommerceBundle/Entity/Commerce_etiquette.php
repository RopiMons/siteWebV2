<?php

namespace Ropi\CommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commerce_etiquette
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Commerce_etiquette
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
     *
     * ORM\ManyToOne(targetEntity="Commerce", inversedBy="id")
     */
    
    private $commerces;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Etiquette", inversedBy="id")
     */
    
    private $etiquettes;
    
    /**
     * @var boolean
     *
     * ORM\Column(name="certification", type="boolean")
     */
    private $certification;


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
     * Set certification
     *
     * @param boolean $certification
     * @return Commerce_etiquette
     */
    public function setCertification($certification)
    {
        $this->certification = $certification;

        return $this;
    }

    /**
     * Get certification
     *
     * @return boolean 
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * Set commerces
     *
     * @param \Ropi\CommerceBundle\Entity\Commerce $commerces
     * @return Commerce_etiquette
     */
    public function setCommerces(\Ropi\CommerceBundle\Entity\Commerce $commerces = null)
    {
        $this->commerces = $commerces;

        return $this;
    }

    /**
     * Get commerces
     *
     * @return \Ropi\CommerceBundle\Entity\Commerce 
     */
    public function getCommerces()
    {
        return $this->commerces;
    }

    /**
     * Set etiquettes
     *
     * @param \Ropi\CommerceBundle\Entity\Etiquette $etiquettes
     * @return Commerce_etiquette
     */
    public function setEtiquettes(\Ropi\CommerceBundle\Entity\Etiquette $etiquettes = null)
    {
        $this->etiquettes = $etiquettes;

        return $this;
    }

    /**
     * Get etiquettes
     *
     * @return \Ropi\CommerceBundle\Entity\Etiquette 
     */
    public function getEtiquettes()
    {
        return $this->etiquettes;
    }
}
