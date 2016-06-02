<?php

namespace Ropi\ParametresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Parametre
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\ParametresBundle\Entity\ParametreRepository")
 *
 * @UniqueEntity(fields={"nom"}, message="Ce parametre existe déjà")
 * 
 */
class Parametre
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
     * @ORM\OneToMany(targetEntity="Parametre", mappedBy="enfant")
     */
    private $parent;
    
    /**
     * @ORM\OneToMany(targetEntity="Parametre", mappedBy="parent")
     */
    private $enfant;

    /**
     * @var string
     *
     * @ORM\Column(name="valeur", type="string", length=255)
     */
    private $valeur;

    /**
     * Set valeur
     *
     * @param string $valeur
     * @return ParametreConcret
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return string
     */
    public function getValeur()
    {
        return $this->valeur;
    }


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
     * Set nom
     *
     * @param string $nom
     * @return Parametre
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Parametre
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set parent
     *
     * @param \Ropi\ParametresBundle\Entity\Parametre $parent
     * @return Parametre
     */
    public function setParent(\Ropi\ParametresBundle\Entity\Parametre $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Ropi\ParametresBundle\Entity\Parametre 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set enfant
     *
     * @param \Ropi\ParametresBundle\Entity\Parametre $enfant
     * @return Parametre
     */
    public function setEnfant(\Ropi\ParametresBundle\Entity\Parametre $enfant = null)
    {
        $this->enfant = $enfant;

        return $this;
    }

    /**
     * Get enfant
     *
     * @return \Ropi\ParametresBundle\Entity\Parametre 
     */
    public function getEnfant()
    {
        return $this->enfant;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enfant = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add parent
     *
     * @param \Ropi\ParametresBundle\Entity\Parametre $parent
     *
     * @return Parametre
     */
    public function addParent(\Ropi\ParametresBundle\Entity\Parametre $parent)
    {
        $this->parent[] = $parent;

        return $this;
    }

    /**
     * Remove parent
     *
     * @param \Ropi\ParametresBundle\Entity\Parametre $parent
     */
    public function removeParent(\Ropi\ParametresBundle\Entity\Parametre $parent)
    {
        $this->parent->removeElement($parent);
    }

    /**
     * Add enfant
     *
     * @param \Ropi\ParametresBundle\Entity\Parametre $enfant
     *
     * @return Parametre
     */
    public function addEnfant(\Ropi\ParametresBundle\Entity\Parametre $enfant)
    {
        $this->enfant[] = $enfant;

        return $this;
    }

    /**
     * Remove enfant
     *
     * @param \Ropi\ParametresBundle\Entity\Parametre $enfant
     */
    public function removeEnfant(\Ropi\ParametresBundle\Entity\Parametre $enfant)
    {
        $this->enfant->removeElement($enfant);
    }
}
