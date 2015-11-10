<?php

namespace Ropi\CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\CommandeBundle\Entity\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;

    /**
     * @ORM\OneToMany(targetEntity="ArticleCommande", mappedBy="article")
     */

    private $commandesQuantite;


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
     * @return Article
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
     * Set image
     *
     * @param string $image
     * @return Article
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Article
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
     * Set prix
     *
     * @param float $prix
     * @return Article
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     * @return Article
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock()
    {
        return $this->stock;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commandesQuantite = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add commandesQuantite
     *
     * @param \Ropi\CommandeBundle\Entity\ArticleCommande $commandesQuantite
     * @return Article
     */
    public function addCommandesQuantite(\Ropi\CommandeBundle\Entity\ArticleCommande $commandesQuantite)
    {
        $this->commandesQuantite[] = $commandesQuantite;

        return $this;
    }

    /**
     * Remove commandesQuantite
     *
     * @param \Ropi\CommandeBundle\Entity\ArticleCommande $commandesQuantite
     */
    public function removeCommandesQuantite(\Ropi\CommandeBundle\Entity\ArticleCommande $commandesQuantite)
    {
        $this->commandesQuantite->removeElement($commandesQuantite);
    }

    /**
     * Get commandesQuantite
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommandesQuantite()
    {
        return $this->commandesQuantite;
    }
}
