<?php

namespace Ropi\IdentiteBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
//use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Personne
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\IdentiteBundle\Entity\PersonneRepository")
 */
class Personne
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
     *  @Assert\Length(min=2, minMessage="Vous devez avoir un nom de min {{ limit }} caractères.",
     * max =50, maxMessage="La longeur du nom ne peux pas dépasser {{ limit }} caractères")  
     * @Assert\NotBlank(message="le champs ne peux pas être vide")
     * @Assert\Regex(pattern="/\d/", match = false ,message="La chaine ne peux pas avoir que des lettres")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50)
     * @Assert\Length(min=2, minMessage="Vous devez avoir un nom de min {{ limit }} caractères.",
     * max =50, maxMessage="La longeur du nom ne peux pas dépasser {{ limit }} caractères")  
     * @Assert\NotBlank(message="le champs ne peux pas être vide")
     * @Assert\Regex(pattern="/\d/", match = false ,message="La chaine ne peux pas avoir que des lettres")
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date")
     */
    private $dateNaissance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creeLe", type="datetime")
     */
    private $creeLe;
    
    /** 
     * @ORM\OneToMany(targetEntity="Contact", mappedBy="personne", cascade={"persist"})
     */
    private $contacts;
    
    /**
     * @ORM\ManyToMany(targetEntity="Ropi\CommerceBundle\Entity\Commerce", mappedBy="personnes", cascade={"remove"})
     */
    private $commerces;
    
    /**
     * @ORM\OneToOne(targetEntity="Ropi\AuthenticationBundle\Entity\IdentifiantWeb", mappedBy="personne")
     */
    private $identifiantWeb;


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
     * @return Personne
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
     * Set prenom
     *
     * @param string $prenom
     * @return Personne
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return Personne
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set creeLe
     *
     * @param \DateTime $creeLe
     * @return Personne
     */
    public function setCreeLe($creeLe)
    {
        $this->creeLe = $creeLe;

        return $this;
    }

    /**
     * Get creeLe
     *
     * @return \DateTime 
     */
    public function getCreeLe()
    {
        return $this->creeLe;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->creeLe = new \DateTime();
        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contacts
     *
     * @param \Ropi\IdentiteBundle\Entity\Contact $contacts
     * @return Personne
     */
    public function addContact(\Ropi\IdentiteBundle\Entity\Contact $contacts)
    {
        $this->contacts[] = $contacts;

        return $this;
    }

    /**
     * Remove contacts
     *
     * @param \Ropi\IdentiteBundle\Entity\Contact $contacts
     */
    public function removeContact(\Ropi\IdentiteBundle\Entity\Contact $contacts)
    {
        $this->contacts->removeElement($contacts);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Add commerces
     *
     * @param \Ropi\CommerceBundle\Entity\Commerce $commerces
     * @return Personne
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

    /**
     * Set identifiantWeb
     *
     * @param \Ropi\AuthenticationBundle\Entity\IdentifiantWeb $identifiantWeb
     * @return Personne
     */
    public function setIdentifiantWeb(\Ropi\AuthenticationBundle\Entity\IdentifiantWeb $identifiantWeb = null)
    {
        $this->identifiantWeb = $identifiantWeb;

        return $this;
    }

    /**
     * Get identifiantWeb
     *
     * @return \Ropi\AuthenticationBundle\Entity\IdentifiantWeb 
     */
    public function getIdentifiantWeb()
    {
        return $this->identifiantWeb;
    }
}
