<?php

namespace Ropi\CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\CommandeBundle\Repository\PaiementRepository")
 */
class Paiement
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
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="referenceComptable", type="string", length=255, nullable=true)
     */
    private $referenceComptable;

    /**
     * @ORM\ManyToOne(targetEntity="Commande", inversedBy="paiements")
     */

    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity="ModeDePaiement")
     */

    private $moyenDePaiement;


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
     * Set montant
     *
     * @param float $montant
     * @return Paiement
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float 
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Paiement
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set referenceComptable
     *
     * @param string $referenceComptable
     * @return Paiement
     */
    public function setReferenceComptable($referenceComptable)
    {
        $this->referenceComptable = $referenceComptable;

        return $this;
    }

    /**
     * Get referenceComptable
     *
     * @return string 
     */
    public function getReferenceComptable()
    {
        return $this->referenceComptable;
    }

    /**
     * Set commande
     *
     * @param \Ropi\CommandeBundle\Entity\Commande $commande
     * @return Paiement
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

    /**
     * Set moyenDePaiement
     *
     * @param \Ropi\CommandeBundle\Entity\ModeDePaiement $moyenDePaiement
     * @return Paiement
     */
    public function setMoyenDePaiement(\Ropi\CommandeBundle\Entity\ModeDePaiement $moyenDePaiement = null)
    {
        $this->moyenDePaiement = $moyenDePaiement;

        return $this;
    }

    /**
     * Get moyenDePaiement
     *
     * @return \Ropi\CommandeBundle\Entity\ModeDePaiement 
     */
    public function getMoyenDePaiement()
    {
        return $this->moyenDePaiement;
    }
}
