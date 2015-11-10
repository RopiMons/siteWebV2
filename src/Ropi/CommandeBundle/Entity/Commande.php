<?php

namespace Ropi\CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\CommandeBundle\Entity\CommandeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Commande
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
     * @ORM\OneToMany(targetEntity="ArticleCommande", mappedBy="commande")
     */

    private $articlesQuantite;

    /**
     * @ORM\ManyToOne(targetEntity="Ropi\IdentiteBundle\Entity\Personne", inversedBy="commande")
     */

    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="Statut", inversedBy="commandes")
     */

    private $statut;

    /**
     * @ORM\OneToMany(targetEntity="Paiement", mappedBy="commande")
     */

    private $paiements;

    /**
     * @ORM\ManyToOne(targetEntity="ModeDePaiement", inversedBy="commandes")
     */

    private $modeDePaiement;

    /**
     * @ORM\ManyToOne(targetEntity="ModeDeLivraison", inversedBy="commandes")
     */

    private $modeDeLivraison;


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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Commande
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
     * @return Commande
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
     * Constructor
     */
    public function __construct()
    {
        $this->articlesQuantite = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add articlesQuantite
     *
     * @param \Ropi\CommandeBundle\Entity\ArticleCommande $articlesQuantite
     * @return Commande
     */
    public function addArticlesQuantite(\Ropi\CommandeBundle\Entity\ArticleCommande $articlesQuantite)
    {
        $this->articlesQuantite[] = $articlesQuantite;

        return $this;
    }

    /**
     * Remove articlesQuantite
     *
     * @param \Ropi\CommandeBundle\Entity\ArticleCommande $articlesQuantite
     */
    public function removeArticlesQuantite(\Ropi\CommandeBundle\Entity\ArticleCommande $articlesQuantite)
    {
        $this->articlesQuantite->removeElement($articlesQuantite);
    }

    /**
     * Get articlesQuantite
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticlesQuantite()
    {
        return $this->articlesQuantite;
    }

    /**
     * Set client
     *
     * @param \Ropi\IdentiteBundle\Entity\Personne $client
     * @return Commande
     */
    public function setClient(\Ropi\IdentiteBundle\Entity\Personne $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Ropi\IdentiteBundle\Entity\Personne 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set statut
     *
     * @param \Ropi\CommandeBundle\Entity\Statut $statut
     * @return Commande
     */
    public function setStatut(\Ropi\CommandeBundle\Entity\Statut $statut = null)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return \Ropi\CommandeBundle\Entity\Statut 
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Add paiements
     *
     * @param \Ropi\CommandeBundle\Entity\Paiement $paiements
     * @return Commande
     */
    public function addPaiement(\Ropi\CommandeBundle\Entity\Paiement $paiements)
    {
        $this->paiements[] = $paiements;

        return $this;
    }

    /**
     * Remove paiements
     *
     * @param \Ropi\CommandeBundle\Entity\Paiement $paiements
     */
    public function removePaiement(\Ropi\CommandeBundle\Entity\Paiement $paiements)
    {
        $this->paiements->removeElement($paiements);
    }

    /**
     * Get paiements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPaiements()
    {
        return $this->paiements;
    }

    /* @ORM\PrePersist */
    public function onPrePersit(){
        $dt = new \DateTime();
        $this->setCreatedAt($dt);
        $this->setUpdateAt($dt);
    }

    /* @ORM\PreUpdate */
    public function onUpdate()
    {
        $this->setUpdateAt(new \DateTime());
    }

    /**
     * Set modeDePaiement
     *
     * @param \Ropi\CommandeBundle\Entity\ModeDePaiement $modeDePaiement
     * @return Commande
     */
    public function setModeDePaiement(\Ropi\CommandeBundle\Entity\ModeDePaiement $modeDePaiement = null)
    {
        $this->modeDePaiement = $modeDePaiement;

        return $this;
    }

    /**
     * Get modeDePaiement
     *
     * @return \Ropi\CommandeBundle\Entity\ModeDePaiement 
     */
    public function getModeDePaiement()
    {
        return $this->modeDePaiement;
    }

    /**
     * Set modeDeLivraison
     *
     * @param \Ropi\CommandeBundle\Entity\ModeDeLivraison $modeDeLivraison
     * @return Commande
     */
    public function setModeDeLivraison(\Ropi\CommandeBundle\Entity\ModeDeLivraison $modeDeLivraison = null)
    {
        $this->modeDeLivraison = $modeDeLivraison;

        return $this;
    }

    /**
     * Get modeDeLivraison
     *
     * @return \Ropi\CommandeBundle\Entity\ModeDeLivraison 
     */
    public function getModeDeLivraison()
    {
        return $this->modeDeLivraison;
    }
}
