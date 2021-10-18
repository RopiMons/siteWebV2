<?php

namespace Ropi\IdentiteBundle\Entity;


use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ropi\AuthenticationBundle\Entity\Cotisation;
use Ropi\AuthenticationBundle\Entity\IdentifiantWeb;
use Ropi\CommandeBundle\Entity\Commande;
use Ropi\CommerceBundle\Entity\Commerce;
use Ropi\IdentiteBundle\Entity\TraitRepo\CotisationManagement;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Personne
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass=PersonneRepository::class)
 */
class Personne
{
    use CotisationManagement;


    public const MembreEffectif = 'Membre Effectif';
    public const MembreSympathisant = 'Membre Sympathisant';
    public const MembreEffectifTemporaire = 'Membre Effectif Temporaire';
    public const MembreVolonte = 'Membre Volonté';

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
     * @Assert\Length(min=2, minMessage="Vous devez avoir un nom de min {{ limit }} caractères.",
     * max =50, maxMessage="La longeur du nom ne peux pas dépasser {{ limit }} caractères")
     * @Assert\NotBlank(message="le champs ne peux pas être vide")
     *
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50)
     * @Assert\Length(min=2, minMessage="Vous devez avoir un nom de min {{ limit }} caractères.",
     * max =50, maxMessage="La longeur du nom ne peux pas dépasser {{ limit }} caractères")
     * @Assert\NotBlank(message="le champs ne peux pas être vide")
     *
     */
    private $prenom;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(name="volonteMembre", type="boolean" , nullable=true, options={"default":false})
     */
    private $volonteMembre = false;

    /**
     * @ORM\OneToMany(targetEntity="Ropi\CommandeBundle\Entity\Commande", mappedBy="client",  cascade={"persist"})
     */

    private $commandes;
    /**
     * @var Boolean
     *
     * @ORM\Column(name="enable", type="boolean", options={"default":true})
     */
    private $enable = true;

    /**
     * @return Boolean
     */
    public function isEnable() : bool
    {
        return $this->enable;
    }

    /**
     * @param Boolean $enable
     */
    public function setEnable(bool $enable) : void
    {
        $this->enable = $enable;
    }




    /**
     * @var DateTime
     *
     * @ORM\Column(name="creeLe", type="datetime")
     */
    private $creeLe;

    /**
     * @ORM\OneToMany(targetEntity="Contact", mappedBy="personne",  cascade={"persist"})
     * @Assert\Valid
     */
    private $contacts;

    /**
     * @ORM\ManyToMany(targetEntity="Ropi\CommerceBundle\Entity\Commerce", mappedBy="personnes", cascade={"persist"})
     */
    private $commerces;

    /**
     * @ORM\OneToOne(targetEntity="Ropi\AuthenticationBundle\Entity\IdentifiantWeb", mappedBy="personne" , cascade={"persist","remove"})
     * @Assert\Valid
     */
    private $identifiantWeb;

    /**
     * @ORM\ManyToMany(targetEntity="Adresse", mappedBy="personnes", cascade={"remove", "persist"})
     * @Assert\Valid
     */
    private $adresses;

    /**
     * @ORM\OneToMany(targetEntity="Ropi\AuthenticationBundle\Entity\Cotisation", mappedBy="personne" , cascade={"persist"})
     */
    private $cotisations;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Personne
     */
    public function setNom(string $nom) : Personne
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() : ?string
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Personne
     */
    public function setPrenom(string $prenom) : self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom() : ?string
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param DateTime $dateNaissance
     * @return Personne
     */
    public function setDateNaissance(DateTime $dateNaissance) : self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return DateTime
     */
    public function getDateNaissance() : ?DateTime
    {
        return $this->dateNaissance;
    }

    /**
     * Set creeLe
     *
     * @param DateTime $creeLe
     * @return Personne
     */
    public function setCreeLe(DateTime $creeLe) : self
    {
        $this->creeLe = $creeLe;

        return $this;
    }

    /**
     * Get creeLe
     *
     * @return null||DateTime
     */
    public function getCreeLe(): ?DateTime
    {
        return $this->creeLe;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->creeLe = new DateTime();
        $this->contacts = new ArrayCollection();
        $this->commerces = new ArrayCollection();
        $this->adresses = new ArrayCollection();
        $this->cotisations = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    /**
     * Add contacts
     *
     * @param Contact $contact
     * @return Personne
     */
    public function addContact(Contact $contact) : self
    {
        if(!$this->contacts->contains($contact)){
            $this->contacts->add($contact);
            $contact->setPersonne($this);
        }

        return $this;
    }

    /**
     * Remove contacts
     *
     * @param Contact $contact
     */
    public function removeContact(Contact $contact) : void
    {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get contacts
     *
     * @return Collection
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Add commerces
     *
     * @param Commerce $commerce
     * @return Personne
     */
    public function addCommerce(Commerce $commerce) : self
    {
        if(!$this->commerces->contains($commerce)){
            $this->commerces->add($commerce);
            $commerce->addPersonne($this);
        }

        return $this;
    }

    /**
     * Remove commerces
     *
     * @param Commerce $commerce
     */
    public function removeCommerce(Commerce $commerce) : void
    {
        $this->commerces->removeElement($commerce);
    }

    /**
     * Get commerces
     *
     * @return Collection
     */
    public function getCommerces()
    {
        return $this->commerces;
    }

    /**
     * Set identifiantWeb
     *
     * @param IdentifiantWeb|null $identifiantWeb
     * @return Personne
     */
    public function setIdentifiantWeb(?IdentifiantWeb $identifiantWeb = null) : self
    {
        if($identifiantWeb!==null){
            $identifiantWeb->setPersonne($this);
        }

        $this->identifiantWeb = $identifiantWeb;

        return $this;
    }

    /**
     * Get identifiantWeb
     *
     * @return IdentifiantWeb
     */
    public function getIdentifiantWeb(): ?IdentifiantWeb
    {
        return $this->identifiantWeb;
    }

    /**
     * Add adresses
     *
     * @param Adresse $adresse
     * @return Personne
     */
    public function addAdress(Adresse $adresse) : self
    {

        if(!$this->adresses->contains($adresse)){
            $this->adresses->add($adresse);
            $adresse->addPersonne($this);
        }

        return $this;
    }

    /**
     * Remove adresses
     *
     * @param Adresse $adresses
     */
    public function removeAdress(Adresse $adresses) : void
    {
        $this->adresses->removeElement($adresses);
    }

    /**
     * Get adresses
     *
     * @return Collection
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
    public function getReelAdresses(): ArrayCollection
    {
        return $this->adresses;
    }


    /**
     * Add commandes
     *
     * @param Commande $commande
     * @return Personne
     */
    public function addCommande(Commande $commande) : self
    {
        if(!$this->commandes->contains($commande)){
            $this->commandes->add($commande);
        }

        return $this;
    }

    /**
     * Remove commandes
     *
     * @param Commande $commande
     */
    public function removeCommande(Commande $commande) : void
    {
        $this->commandes->removeElement($commande);
    }

    /**
     * Get commandes
     *
     * @return Collection
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    public function getEmail(){

        foreach($this->getContacts() as $contact){
            if($contact->getTypeContact()->getValidateur() === "Email"){
                $mail = $contact->getValeur();
            }
        }

        return $mail ?? null;

    }
    public function __toString()
    {
        return $this->nom;
    }

    /**
     * Set volonteMembre
     *
     * @param bool $volonteMembre
     *
     * @return Personne
     */
    public function setVolonteMembre(bool $volonteMembre): self
    {
        $this->volonteMembre = $volonteMembre;

        return $this;
    }

    /**
     * Get volonteMembre
     *
     * @return Boolean
     */
    public function getVolonteMembre() : ?bool
    {
        return $this->volonteMembre;
    }

    /**
     * Add cotisation
     *
     * @param Cotisation $cotisation
     *
     * @return Personne
     */
    public function addCotisation(Cotisation $cotisation) : self
    {
        if(!$this->cotisations->contains($cotisation))
        {
            $this->cotisations->add($cotisation);
        }

        return $this;
    }

    /**
     * Remove cotisation
     *
     * @param Cotisation $cotisation
     */
    public function removeCotisation(Cotisation $cotisation) : void
    {
        $this->cotisations->removeElement($cotisation);
    }

    /**
     * Get cotisations
     *
     * @return Collection
     */
    public function getCotisations()
    {
        return $this->cotisations;
    }

    
    public function getMembreStatut(): string
    {

        if ($this->hasActifCotisation()) {
            return self::MembreEffectif;
        }

        if ($this->hasActifProcedurePaiement()) {
            return self::MembreEffectifTemporaire;
        }

        if($this->volonteMembre) {
            return self::MembreVolonte;
        }

        return self::MembreSympathisant;
    }



    /**
     * Get enable.
     *
     * @return bool
     */
    public function getEnable(): bool
    {
        return $this->enable;
    }
}
