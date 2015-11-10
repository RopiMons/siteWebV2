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
 * @ORM\Entity(repositoryClass="Ropi\CommandeBundle\Entity\ModeDePaiementRepository")
 *
 */
class ModeDePaiement extends Mode
{
    /**
     * @ORM\OneToMany(targetEntity="Commande", mappedBy="modeDePaiement")
     */

    private $commandes;
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
     * @return ModeDePaiement
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
}
