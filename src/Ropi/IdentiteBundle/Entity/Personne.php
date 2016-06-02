<?php

namespace Ropi\IdentiteBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(name="volonteMembre", type="boolean")
     */
    private $volonteMembre = false;

    /**
     * @ORM\OneToMany(targetEntity="Ropi\CommandeBundle\Entity\Commande", mappedBy="client")
     */

    private $commandes;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creeLe", type="datetime")
     */
    private $creeLe;
    
    /** 
     * @ORM\OneToMany(targetEntity="Contact", mappedBy="personne", cascade={"persist","remove"})
     * @Assert\Valid
     */
    private $contacts;
    
    /**
     * @ORM\ManyToMany(targetEntity="Ropi\CommerceBundle\Entity\Commerce", mappedBy="personnes", cascade={"persist","remove"})
     */
    private $commerces;
    
    /**
     * @ORM\OneToOne(targetEntity="Ropi\AuthenticationBundle\Entity\IdentifiantWeb", mappedBy="personne" , cascade={"remove"})
     * @Assert\Valid
     */
    private $identifiantWeb;
    
    /**
     * @ORM\ManyToMany(targetEntity="Adresse", mappedBy="personnes", cascade={"persist","remove"})
     * @Assert\Valid
     */
    private $adresses;

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

        $this->adresses = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add adresses
     *
     * @param \Ropi\IdentiteBundle\Entity\Adresse $adresses
     * @return Personne
     */
    public function addAdress(\Ropi\IdentiteBundle\Entity\Adresse $adresses)
    {
        $this->adresses[] = $adresses;

        return $this;
    }

    /**
     * Remove adresses
     *
     * @param \Ropi\IdentiteBundle\Entity\Adresse $adresses
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
        $retour = new ArrayCollection();

        foreach ($this->adresses as $adresse){
            if($adresse->getActif()){
                $retour->add($adresse);
            }
        }

        return ($retour->count() > 0) ? $retour : null;
    }



    /**
     * Add commandes
     *
     * @param \Ropi\CommandeBundle\Entity\Commande $commandes
     * @return Personne
     */
    public function addCommande(\Ropi\CommandeBundle\Entity\Commande $commandes)
    {
        $this->commandes[] = $commandes;

        return $this;
    }

    /**
     * Remove commandes
     *
     * @param \Ropi\CommandeBundle\Entity\Commande $commandes
     */
    public function removeCommande(\Ropi\CommandeBundle\Entity\Commande $commandes)
    {
        $this->commandes->removeElement($commandes);
    }

    /**
     * Get commandes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    public function getEmail(){

        foreach($this->getContacts() as $contact){
            if($contact->getTypeContact()->getValidateur()=="Email"){
                $mail = $contact->getValeur();
            }
        }

        if(isset($mail)){
            return $mail;
        }
    }
    public function __toString()
    {
     return $this->nom;
    }

    /**
     * Set volonteMembre
     *
     * @param boolean $volonteMembre
     *
     * @return Personne
     */
    public function setVolonteMembre($volonteMembre)
    {
        $this->volonteMembre = $volonteMembre;

        return $this;
    }

    /**
     * Get volonteMembre
     *
     * @return boolean
     */
    public function getVolonteMembre()
    {
        return $this->volonteMembre;
    }
}
