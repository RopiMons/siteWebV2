<?php

namespace Ropi\CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticleCommande
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ArticleCommande
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
     * @var float
     *
     * @ORM\Column(name="quantite", type="float")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="commandesQuantite")
     */

    private $article;

    /**
     * @ORM\ManyToOne(targetEntity="Commande", inversedBy="articlesQuantite")
     */

    private $commande;


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
     * Set quantite
     *
     * @param float $quantite
     * @return ArticleCommande
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return float 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set article
     *
     * @param \Ropi\CommandeBundle\Entity\Article $article
     * @return ArticleCommande
     */
    public function setArticle(\Ropi\CommandeBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Ropi\CommandeBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set commande
     *
     * @param \Ropi\CommandeBundle\Entity\Commande $commande
     * @return ArticleCommande
     */
    public function setCommande(\Ropi\CommandeBundle\Entity\Commande $commande = null)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \Ropi\CommandeBundle\Entity\Commande 
     */
    public function getCommande()
    {
        return $this->commande;
    }
}
