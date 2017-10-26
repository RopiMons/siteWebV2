<?php

namespace Ropi\CommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ropi\AuthenticationBundle\Entity\Cotisation;
use Ropi\IdentiteBundle\Entity\TraitRepo\CotisationManagement;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Commerce
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\CommerceBundle\Entity\CommerceRepository")
 *
 * @ORM\HasLifecycleCallbacks()
 *
 * @UniqueEntity(fields={"nom"}, message="Un commerce a déjà ce nom")
 *
 * @Vich\Uploadable
 */
class Commerce
{
    use CotisationManagement;


    const MembreEffectif = 'Membre Effectif';
    const MembreSympathisant = 'Membre Sympathisant';
    const MembreEffectifTemporaire = 'Membre Effectif Temporaire';
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
     * @Assert\NotNull()
     * @Assert\NotBlank()
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
     * @ORM\ManyToOne(targetEntity="Ropi\AuthenticationBundle\Entity\College", inversedBy="membres")
     */
    private $college;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="Ropi\AuthenticationBundle\Entity\Cotisation", mappedBy="commerce", cascade={"persist"})
     */
    private $cotisations;

    /**
     * @ORM\OneToMany(targetEntity="Ropi\IdentiteBundle\Entity\Adresse", mappedBy="commerce", cascade={"persist","remove"})
     * @Assert\Valid
     */
    private $adresses;

    /**
     * @ORM\ManyToMany(targetEntity="Ropi\IdentiteBundle\Entity\Personne", inversedBy="commerces")
     */
    private $personnes;

    /**
     *
     * ORM\OneToMany(targetEntity="Etiquette", mappedBy="commerces", cascade="remove")
     */
    private $etiquettes;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="logo_image", fileNameProperty="logo")
     *
     * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 400,
     *     minHeight = 200,
     *     maxHeight = 400
     * )
     *
     * @Assert\NotNull(message="Merci d'uploader votre logo")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     *
     *
     */
    private $logo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="depot", type="boolean")
     *
     */
    
    private $depot;

    /**
     * @ORM\Column(name="lat", type="float", nullable=true)
     */
    private $lat;

    /**
     * @ORM\Column(name="lon", type="float", nullable=true)
     */
    private $lon;

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
        return $this->visible && $this->hasActifCotisation();
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
     * @param \Ropi\CommerceBundle\Entity\Etiquette $etiquettes
     * @return Commerce
     */
    public function addEtiquette(\Ropi\CommerceBundle\Entity\Etiquette $etiquettes)
    {
        $this->etiquettes[] = $etiquettes;

        return $this;
    }

    /**
     * Remove etiquettes
     *
     * @param \Ropi\CommerceBundle\Entity\Etiquette $etiquettes
     */
    public function removeEtiquette(\Ropi\CommerceBundle\Entity\Etiquette $etiquettes)
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

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Commerce
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
     * Set depot
     *
     * @param boolean $depot
     * @return Commerce
     */
    public function setDepot($depot)
    {
        $this->depot = $depot;

        return $this;
    }

    /**
     * Get depot
     *
     * @return boolean 
     */
    public function getDepot()
    {
        return $this->depot;
    }

    public function getCommerceImplentationAdresse(){
        foreach($this->getAdresses() as $adresse){
            if($adresse->getTypeAdresse()->getValeur() == "Adresse du commerce"){
                return $adresse;
            }
        }
    }

    /**
     * Set lat
     *
     * @param float $lat
     *
     * @return Commerce
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }


    /**
     * Set lon
     *
     * @param float $lon
     *
     * @return Commerce
     */
    public function setLon($lon)
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * Get lon
     *
     * @return float
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * Set college
     *
     * @param \Ropi\AuthenticationBundle\Entity\College $college
     *
     * @return Commerce
     */
    public function setCollege(\Ropi\AuthenticationBundle\Entity\College $college = null)
    {
        $this->college = $college;

        return $this;
    }

    /**
     * Get college
     *
     * @return \Ropi\AuthenticationBundle\Entity\College
     */
    public function getCollege()
    {
        return $this->college;
    }

    /**
     * @return Cotisation
     */
    public function getCotisations()
    {
        return $this->cotisations;
    }

    /**
     * Add cotisation
     *
     * @param \Ropi\AuthenticationBundle\Entity\Cotisation $cotisation
     *
     * @return Commerce
     */
    public function addCotisation(\Ropi\AuthenticationBundle\Entity\Cotisation $cotisation)
    {
        $this->cotisations[] = $cotisation;

        return $this;
    }

    /**
     * Remove cotisation
     *
     * @param \Ropi\AuthenticationBundle\Entity\Cotisation $cotisation
     */
    public function removeCotisation(\Ropi\AuthenticationBundle\Entity\Cotisation $cotisation)
    {
        $this->cotisations->removeElement($cotisation);
    }

    public function getMembreStatut(){

        if($this->hasActifCotisation()){
            return self::MembreEffectif;
        }elseif($this->hasActifProcedurePaiement()){
            return self::MembreEffectifTemporaire;;
        }else{
            return self::MembreSympathisant;
        }
    }
}
