<?php

namespace Ropi\CommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Etiquette
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\CommerceBundle\Repository\EtiquetteRepository") *
 */
class Etiquette
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
     * @ORM\Column(name="nom", type="string", length=50)
     * @Assert\Length(min=3, minMessage="Vous devez avoir un nom d'utilisateur de min {{ limit }} caractères.",
     * max =50, maxMessage="La longeur du nom ne peux pas dépasser {{ limit }} caractères")
     *
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="certification", type="boolean")
     */
    private $certification;

    /**
     *
     * ORM\ManyToOne(targetEntity="Commerce", inversedBy="etiquettes")
     */
    private $commerces;

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
     * @return Etiquette
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
     * @return Etiquette
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
     * Set logo
     *
     * @param string $logo
     * @return Etiquette
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set certification
     *
     * @param boolean $certification
     * @return Etiquette
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
     * Constructor
     */
    public function __construct()
    {
        $this->commerces = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add commerces
     *
     * @param \Ropi\CommerceBundle\Entity\Commerce $commerces
     * @return Commerce
     */
    public function addCommerce(\Ropi\CommerceBundle\Entity\Commerce $commerces)
    {
        $this->commerces[] = $commerces;

        return $this;
    }

    /**
     * Remove commerces
     *
     * @param \Ropi\CommerceBundle\Entity\Commerce $commerces
     */
    public function removeCommerce(\Ropi\CommerceBundle\Entity\Commerce $commerces)
    {
        $this->commerces->removeElement($commerces);
    }

    /**
     * Get commerces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommerces()
    {
        return $this->commerces;
    }

}
