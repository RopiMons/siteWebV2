<?php

namespace Ropi\CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statut
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\CommandeBundle\Entity\StatutRepository")
 */
class Statut
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
     * @var boolean
     *
     * @ORM\Column(name="notifierClient", type="boolean")
     */
    private $notifierClient;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notifierAdmin", type="boolean")
     */
    private $notifierAdmin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="delay", type="string", length=255)
     */
    private $delay;

    /**
     * @ORM\OneToMany(targetEntity="Statut", mappedBy="statut")
     */

    private $commandes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;


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
     * @return Statut
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
     * @return Statut
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
     * Set notifierClient
     *
     * @param boolean $notifierClient
     * @return Statut
     */
    public function setNotifierClient($notifierClient)
    {
        $this->notifierClient = $notifierClient;

        return $this;
    }

    /**
     * Get notifierClient
     *
     * @return boolean 
     */
    public function getNotifierClient()
    {
        return $this->notifierClient;
    }

    /**
     * Set notifierAdmin
     *
     * @param boolean $notifierAdmin
     * @return Statut
     */
    public function setNotifierAdmin($notifierAdmin)
    {
        $this->notifierAdmin = $notifierAdmin;

        return $this;
    }

    /**
     * Get notifierAdmin
     *
     * @return boolean 
     */
    public function getNotifierAdmin()
    {
        return $this->notifierAdmin;
    }

    /**
     * Set delay
     *
     * @param \DateTime $delay
     * @return Statut
     */
    public function setDelay($delay)
    {
        $this->delay = $delay;

        return $this;
    }

    /**
     * Get delay
     *
     * @return \DateTime 
     */
    public function getDelay()
    {
        return $this->delay;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commandes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add commandes
     *
     * @param \Ropi\CommandeBundle\Entity\Statut $commandes
     * @return Statut
     */
    public function addCommande(\Ropi\CommandeBundle\Entity\Statut $commandes)
    {
        $this->commandes[] = $commandes;

        return $this;
    }

    /**
     * Remove commandes
     *
     * @param \Ropi\CommandeBundle\Entity\Statut $commandes
     */
    public function removeCommande(\Ropi\CommandeBundle\Entity\Statut $commandes)
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

    /**
     * Set ordre
     *
     * @param integer $ordre
     * @return Statut
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer 
     */
    public function getOrdre()
    {
        return $this->ordre;
    }
}
