<?php

namespace Ropi\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cotisation
 *
 * @ORM\Table(name="cotisation")
 * @ORM\Entity(repositoryClass="Ropi\AuthenticationBundle\Repository\CotisationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Cotisation
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
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity="College")
     */
    private $college;


    /**
     * @ORM\OneToMany(targetEntity="PaiementCot", mappedBy="cotisation", cascade={"persist"})
     */
    private $paiements;

    /**
     * @ORM\ManyToOne(targetEntity="Ropi\IdentiteBundle\Entity\Personne", inversedBy="cotisations")
     */
    private $personne;

    /**
     * @ORM\ManyToOne(targetEntity="Ropi\CommerceBundle\Entity\Commerce", inversedBy="cotisations", cascade={"persist"})
     */
    private $commerce;


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
     * Set montant
     *
     * @param float $montant
     *
     * @return Cotisation
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
     * Constructor
     */
    public function __construct()
    {
        $this->paiements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set college
     *
     * @param \Ropi\AuthenticationBundle\Entity\College $college
     *
     * @return Cotisation
     */
    public function setCollege(\Ropi\AuthenticationBundle\Entity\College $college = null)
    {
        $this->college = $college;

        return $this;
    }

    /**
     * Get college
     *
     * @return \Ropi\AuthenticationBundle\Entity\College
     */
    public function getCollege()
    {
        return $this->college;
    }

    /**
     * Add paiement
     *
     * @param \Ropi\AuthenticationBundle\Entity\Paiement $paiement
     *
     * @return Cotisation
     */
    public function addPaiement(\Ropi\AuthenticationBundle\Entity\PaiementCot $paiement)
    {
        $this->paiements[] = $paiement;

        return $this;
    }

    /**
     * Remove paiement
     *
     * @param \Ropi\AuthenticationBundle\Entity\Paiement $paiement
     */
    public function removePaiement(\Ropi\AuthenticationBundle\Entity\PaiementCot $paiement)
    {
        $this->paiements->removeElement($paiement);
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

    /**
     * Set personne
     *
     * @param \Ropi\IdentiteBundle\Entity\Personne $personne
     *
     * @return Cotisation
     */
    public function setPersonne(\Ropi\IdentiteBundle\Entity\Personne $personne = null)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne
     *
     * @return \Ropi\IdentiteBundle\Entity\Personne
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    public function getMontantDejaPaye(){
        $montant = 0;
        foreach ($this->paiements as $paiement){
            $montant += $paiement->getMontant();
        }
        return $montant;
    }

    public function isPaye(){
        return $this->getMontantDejaPaye() >= $this->montant && $this->montant!=0;
    }

    public function getLastPaiement(){
        $last = null;
        foreach ($this->paiements as $paiement){
            if($last==null){
                $last = $paiement;
            }else{
                if($last->getDateOperation() < $paiement->getDateOperation()){
                    $last = $paiement;
                }
            }
        }

        return $last;
    }

    public function getDateEcheance(){

        if($this->isPaye()){
            $date = clone $this->getLastPaiement()->getDateOperation();
            return date_modify($date, '+1 year');
        }
    }

    /** @ORM\PrePersist */
    public function onPrePersist(){
        $this->dateCreation = new \DateTime();
    }

    public function getDetteTotale(){
        return $this->montant - $this->getMontantDejaPaye();
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Cotisation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set commerce
     *
     * @param \Ropi\CommerceBundle\Entity\Commerce $commerce
     *
     * @return Cotisation
     */
    public function setCommerce(\Ropi\CommerceBundle\Entity\Commerce $commerce = null)
    {
        $this->commerce = $commerce;

        return $this;
    }

    /**
     * Get commerce
     *
     * @return \Ropi\CommerceBundle\Entity\Commerce
     */
    public function getCommerce()
    {
        return $this->commerce;
    }
}
