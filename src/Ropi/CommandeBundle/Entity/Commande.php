<?php

namespace Ropi\CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Commande
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\CommandeBundle\Repository\CommandeRepository")
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
     * @var integer
     *
     * @ORM\Column(name="refCommande", type="string")
     *
     */

    private $refCommande;



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
     * @ORM\OneToMany(targetEntity="ArticleCommande", mappedBy="commande", cascade={"all"})
     *
     * @Assert\Valid()
     */

    private $articlesQuantite;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Ropi\IdentiteBundle\Entity\Personne", inversedBy="commandes", cascade={"persist"})
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
     *
     */



    private $modeDePaiement;

    /**
     * @ORM\ManyToOne(targetEntity="ModeDeLivraison", inversedBy="commandes")
     *
     * @Assert\NotBlank()
     *
     */

    private $modeDeLivraison;

    /**
     * @ORM\ManyToOne(targetEntity="Ropi\IdentiteBundle\Entity\Adresse")
     *
     * @Assert\NotBlank()
     *
     */

    private $adresseDeLivraison;


    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $archive;


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

    /** @ORM\PrePersist */
    public function onPrePersit(){
        $dt = new \DateTime();
        $this->archive = false;
        $this->setCreatedAt($dt);
        $this->routine($dt);

        $this->setRefCommande(0);
    }

    /** @ORM\PreUpdate */
    public function onUpdate()
    {
        $this->routine();
    }

    private function routine($dt = null){
        if(!$dt){
            $dt = new \DateTime();
        }

        $this->setUpdateAt($dt);

        foreach($this->getArticlesQuantite() as $ac){
            if($ac->getQuantite() <= 0){
                $this->removeArticlesQuantite($ac);
            }
        }
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

    /**
     * Set adresseDeLivraison
     *
     * @param \Ropi\IdentiteBundle\Entity\Adresse $adresseDeLivraison
     * @return Commande
     */
    public function setAdresseDeLivraison(\Ropi\IdentiteBundle\Entity\Adresse $adresseDeLivraison = null)
    {
        $this->adresseDeLivraison = $adresseDeLivraison;

        return $this;
    }

    /**
     * Get adresseDeLivraison
     *
     * @return \Ropi\IdentiteBundle\Entity\Adresse 
     */
    public function getAdresseDeLivraison()
    {
        return $this->adresseDeLivraison;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        $sommeDArticle = false;
        foreach($this->getArticlesQuantite() as $ac){
            if($ac->getQuantite()>0){
                $sommeDArticle = true;
                break;
            }
        }

        if(!$sommeDArticle){
            $context->buildViolation('Votre commande ne contient aucun article')->atPath('articlesQuantite')->addViolation();
        }
    }

    public function getPrix(){
        $solde = 0;

            foreach($this->getArticlesQuantite() as $ac){
            $solde += $ac->getQuantite() * $ac->getArticle()->getPrix();
        }

        if($this->getModeDeLivraison())
            $solde += $this->getModeDeLivraison()->getFrais();

        if($this->getModeDePaiement())
            $solde += $this->getModeDePaiement()->getComputeFrais($solde);

        return $solde;
    }

    public function calcRefCommande(){
        $annee = date('Y');
        $id = $this->getId();

        $chaine = $annee.$id;

        $boucle = 6 - ceil(log10($id));

        while($boucle){

            $chaine = substr_replace($chaine,"0",4,0);
            $boucle -= 1;
        }
        $modulo = (int)$chaine % 97;

        if(ceil(log10($modulo))==1){
            $modulo = substr_replace($modulo,"0",0,0);
        }

        $chaine = substr_replace($chaine,$modulo,10,0);

        $this->setRefCommande($chaine);

    }

    /**
     * Set refCommande
     *
     * @param string $refCommande
     * @return Commande
     */
    public function setRefCommande($refCommande)
    {
        $this->refCommande = $refCommande;

        return $this;
    }

    /**
     * Get refCommande
     *
     * @return string 
     */
    public function getRefCommande()
    {
        return $this->refCommande;
    }

    public function getComStructure(){
        $communication = $this->getRefCommande();

        return "+++".substr($communication,0,3)."/".substr($communication,3,4)."/".substr($communication,7,5)."+++";
    }

    public function getSolde(){
        $montantTotal = $this->getPrix();

        /** @var Paiement $paiement */
        foreach ($this->getPaiements() as $paiement){
            $montantTotal -= $paiement->getMontant();
        }

        return $montantTotal;
    }

    /**
     * @return \DateTime|null
     */
    public function datePaiement(){
        $date = null;
        if($this->getSolde() <= 0){

            /** @var Paiement $paiement */
            foreach ($this->getPaiements() as $paiement){
                if($date === null || $paiement->getDate() > $date){
                    $date = $paiement->getDate();
                }
            }

        }

        return $date;
    }

    /**
     * Set archive.
     *
     * @param bool $archive
     *
     * @return Commande
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive.
     *
     * @return bool
     */
    public function getArchive()
    {
        return $this->archive;
    }
}
