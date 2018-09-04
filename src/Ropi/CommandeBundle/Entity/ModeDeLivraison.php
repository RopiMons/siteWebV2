<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 10/11/15
 * Time: 0:22
 */

namespace Ropi\CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Mode
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\CommandeBundle\Repository\ModeDeLivraisonRepository")
 *
 */
class ModeDeLivraison extends Mode
{
    /**
     * @ORM\OneToMany(targetEntity="Commande", mappedBy="modeDeLivraison")
     */

    private $commandes;

    /**
     * @var string
     *
     * @ORM\Column(name="regleCp", type="string", length=255)
     */
    private $regleCP;

    /**
     * @var boolean
     *
     * @ORM\Column(name="aDomicile", type="boolean")
     */
    private $aDomicile;


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
     * @param \Ropi\CommandeBundle\Entity\Commande $commandes
     * @return ModeDeLivraison
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

    /**
     * Set regleCP
     *
     * @param string $regleCP
     * @return ModeDeLivraison
     */
    public function setRegleCP($regleCP)
    {
        $this->regleCP = $regleCP;

        return $this;
    }

    /**
     * Get regleCP
     *
     * @return string 
     */
    public function getRegleCP()
    {
        return $this->regleCP;
    }

    /**
     * Set aDomicile
     *
     * @param boolean $aDomicile
     * @return ModeDeLivraison
     */
    public function setADomicile($aDomicile)
    {
        $this->aDomicile = $aDomicile;

        return $this;
    }

    /**
     * Get aDomicile
     *
     * @return boolean 
     */
    public function getADomicile()
    {
        return $this->aDomicile;
    }
}
