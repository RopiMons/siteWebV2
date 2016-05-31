<?php

namespace Ropi\ParametresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parametre
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\ParametresBundle\Entity\ParametreRepository")
 * 
 * @ORM\MappedSuperclass
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"bool"="ParametreBool", "concret"="ParametreConcret"})
 * 
 */
abstract class Parametre
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
     * @ORM\OneToOne(targetEntity="Parametre", mappedBy="enfant")
     */
    private $parent;
    
    /**
     * @ORM\OneToOne(targetEntity="Parametre", mappedBy="parent")
     */
    private $enfant;


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
}
