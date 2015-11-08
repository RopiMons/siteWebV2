<?php

namespace Ropi\IdentiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ville
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\IdentiteBundle\Entity\VilleRepository")
 */
class Ville
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
     * @ORM\Column(name="codePostal", type="string", length=15)
     * @Assert\Length(min="4", max="15")
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $ville;

    /**
     * @var pays
     *
     * @ORM\ManyToOne(targetEntity="Ropi\IdentiteBundle\Entity\Pays", inversedBy="ville")
     *
     */
    private $pays;

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
     * Set codePostal
     *
     * @param string $codePostal
     * @return Ville
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string 
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pays = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get pays
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set pays
     *
     * @param \Ropi\IdentiteBundle\Entity\Pays $pays
     * @return Ville
     */
    public function setPays(\Ropi\IdentiteBundle\Entity\Pays $pays = null)
    {
        $this->pays = $pays;

        return $this;
    }
}
