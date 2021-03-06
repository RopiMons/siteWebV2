<?php

namespace Ropi\IdentiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Adresse
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\IdentiteBundle\Entity\AdresseRepository")
 */
class Adresse
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
     * @ORM\Column(name="rue", type="string", length=255)
     */
    private $rue;

    /**
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif;


    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=10)
     * @Assert\NotBlank( )
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="complement", type="string", length=255, nullable=true)
     */
    private $complement;
    
    /**
     * @ORM\ManyToOne(targetEntity="TypeAdresse")
     * @Assert\NotBlank( groups={"registration"})
     */
    private $typeAdresse;
    
    /**
     * @ORM\ManyToOne(targetEntity="Ville", cascade={"persist"})
     * @Assert\Valid
     */
    private $ville;
    
    /**
     * @ORM\ManyToOne(targetEntity="Ropi\CommerceBundle\Entity\Commerce", inversedBy="adresses", cascade={"persist"})
     * @Assert\Valid
     */
    private $commerce;
    
    /**
     * @ORM\ManyToMany(targetEntity="Personne",inversedBy="adresses", cascade={"persist"})
     */
    private $personnes;
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
     * Set rue
     *
     * @param string $rue
     * @return Adresse
     */
    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get rue
     *
     * @return string 
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * Set numero
     *
     * @param string $numero
     * @return Adresse
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set complement
     *
     * @param string $complement
     * @return Adresse
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get complement
     *
     * @return string 
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set typeAdresse
     *
     * @param \Ropi\IdentiteBundle\Entity\TypeAdresse $typeAdresse
     * @return Adresse
     */
    public function setTypeAdresse(\Ropi\IdentiteBundle\Entity\TypeAdresse $typeAdresse = null)
    {
        $this->typeAdresse = $typeAdresse;

        return $this;
    }

    /**
     * Get typeAdresse
     *
     * @return \Ropi\IdentiteBundle\Entity\TypeAdresse 
     */
    public function getTypeAdresse()
    {
        return $this->typeAdresse;
    }

    /**
     * Set ville
     *
     * @param \Ropi\IdentiteBundle\Entity\Ville $ville
     * @return Adresse
     */
    public function setVille(\Ropi\IdentiteBundle\Entity\Ville $ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \Ropi\IdentiteBundle\Entity\Ville 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set commerce
     *
     * @param \Ropi\IdentiteBundle\Entity\Commerce $commerce
     * @return Adresse
     */
    public function setCommerce(\Ropi\CommerceBundle\Entity\Commerce $commerce = null)
    {
        $this->commerce = $commerce;

        return $this;
    }

    /**
     * Get commerce
     *
     * @return \Ropi\IdentiteBundle\Entity\Commerce 
     */
    public function getCommerce()
    {
        return $this->commerce;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->personnes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setActif(true);
    }

    /**
     * Add personnes
     *
     * @param \Ropi\IdentiteBundle\Entity\Personne $personnes
     * @return Adresse
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
    public function __toString() {
        return $this->rue;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return Adresse
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean
     */
    public function getActif()
    {

        return $this->actif;
    }
}
