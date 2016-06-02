<?php

namespace Ropi\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * College
 *
 * @ORM\Table(name="college")
 * @ORM\Entity(repositoryClass="Ropi\AuthenticationBundle\Repository\CollegeRepository")
 */
class College
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\Column(name="numero", type="integer")
     *
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity="Ropi\CommerceBundle\Entity\Commerce", mappedBy="college")
     */
    private $membres;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return College
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
     * Constructor
     */
    public function __construct()
    {
        $this->membres = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add membre
     *
     * @param \Ropi\CommerceBundle\Entity\Commerce $membre
     *
     * @return College
     */
    public function addMembre(\Ropi\CommerceBundle\Entity\Commerce $membre)
    {
        $this->membres[] = $membre;

        return $this;
    }

    /**
     * Remove membre
     *
     * @param \Ropi\CommerceBundle\Entity\Commerce $membre
     */
    public function removeMembre(\Ropi\CommerceBundle\Entity\Commerce $membre)
    {
        $this->membres->removeElement($membre);
    }

    /**
     * Get membres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembres()
    {
        return $this->membres;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return College
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}
