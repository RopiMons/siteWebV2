<?php

namespace Ropi\CommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Commerce
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\CommerceBundle\Entity\CommerceRepository")
 * 
 * @ORM\HasLifecycleCallbacks()
 * 
 * @UniqueEntity(fields={"nom"}, message="Un commerce a déjà ce nom")
 */
class Commerce
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
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
     * @var string
     *
     * @ORM\Column(name="valide", type="boolean")
     */
    private $valide;
    
    /**
     * @var string
     *
     * @ORM\Column(name="visible", type="boolean")
     */
    private $visible;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateAt", type="datetime")
     */
    private $updateAt;
    
    /**
     * @ORM\OneToMany(targetEntity="Ropi\IdentiteBundle\Entity\Adresse", mappedBy="commerce", cascade={"persist","remove"})
     */
    private $adresses;
    
    /**
     * @ORM\ManyToMany(targetEntity="Ropi\IdentiteBundle\Entity\Personne", inversedBy="commerces")
     */
    private $personnes;

    /**
     *
     * ORM\OneToMany(targetEntity="Commerce_etiquette", mappedBy="commerces", cascade="remove") 
     */
    private $etiquettes;
    
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
     * @return Commerce
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
     * @return Commerce
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Commerce
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return Commerce
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime 
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function onPrePersist(){
        $now = new \DateTime();
        $this->createdAt = $now;
        $this->updateAt = $now;
        
        if(!isset($this->valide)){
            $this->valide = false;
        }
        
        if(!isset($this->visible)){
            $this->visible = false;
        }
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate(){
        $this->updateAt = new \DateTime();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->adresses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add adresses
     *
     * @param \Ropi\CommerceBundle\Entity\Adresse $adresses
     * @return Commerce
     */
    public function addAdress(\Ropi\IdentiteBundle\Entity\Adresse $adresses)
    {
        $this->adresses[] = $adresses;

        return $this;
    }

    /**
     * Remove adresses
     *
     * @param \Ropi\CommerceBundle\Entity\Adresse $adresses
     */
    public function removeAdress(\Ropi\IdentiteBundle\Entity\Adresse $adresses)
    {
        $this->adresses->removeElement($adresses);
    }

    /**
     * Get adresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdresses()
    {
        return $this->adresses;
    }

    /**
     * Set valide
     *
     * @param boolean $valide
     * @return Commerce
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return boolean 
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return Commerce
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean 
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Add personnes
     *
     * @param \Ropi\IdentiteBundle\Entity\Personne $personnes
     * @return Commerce
     */
    public function addPersonne(\Ropi\IdentiteBundle\Entity\Personne $personnes)
    {
        $this->personnes[] = $personnes;

        return $this;
    }

    /**
     * Remove personnes
     *
     * @param \Ropi\IdentiteBundle\Entity\Personne $personnes
     */
    public function removePersonne(\Ropi\IdentiteBundle\Entity\Personne $personnes)
    {
        $this->personnes->removeElement($personnes);
    }

    /**
     * Get personnes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersonnes()
    {
        return $this->personnes;
    }

    /**
     * Add etiquettes
     *
     * @param \Ropi\CommerceBundle\Entity\Commerce_etiquette $etiquettes
     * @return Commerce
     */
    public function addEtiquette(\Ropi\CommerceBundle\Entity\Commerce_etiquette $etiquettes)
    {
        $this->etiquettes[] = $etiquettes;

        return $this;
    }

    /**
     * Remove etiquettes
     *
     * @param \Ropi\CommerceBundle\Entity\Commerce_etiquette $etiquettes
     */
    public function removeEtiquette(\Ropi\CommerceBundle\Entity\Commerce_etiquette $etiquettes)
    {
        $this->etiquettes->removeElement($etiquettes);
    }

    /**
     * Get etiquettes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEtiquettes()
    {
        return $this->etiquettes;
    }
}
