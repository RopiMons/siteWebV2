<?php

namespace Ropi\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Paiement
 *
 * @ORM\Table(name="paiement_cot")
 * @ORM\Entity(repositoryClass="Ropi\AuthenticationBundle\Repository\PaiementRepository")
 */
class PaiementCot
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
     * @var string
     *
     * @ORM\Column(name="numOperation", type="string", length=255)
     */
    private $numOperation;

    /**
     * @var \Date
     *
     * @ORM\Column(name="dateOperation", type="date")
     */
    private $dateOperation;

    /**
     * @ORM\ManyToOne(targetEntity="Cotisation", inversedBy="paiements")
     */
    private $cotisation;

    /** @Assert\Callback */
    public function validate(ExecutionContextInterface $context, $payload){
        $dette = $this->cotisation->getDetteTotale();
        if($this->montant>$dette){
            $context->buildViolation('Le montant est plus élevé que la dette de ce membre ('.$dette.')')
                ->atPath('montant')
                ->addViolation()
                ;
        }
    }


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
     * Set numOperation
     *
     * @param string $numOperation
     *
     * @return Paiement
     */
    public function setNumOperation($numOperation)
    {
        $this->numOperation = $numOperation;

        return $this;
    }

    /**
     * Get numOperation
     *
     * @return string
     */
    public function getNumOperation()
    {
        return $this->numOperation;
    }

    /**
     * Set dateOperation
     *
     * @param \Date $dateOperation
     *
     * @return Paiement
     */
    public function setDateOperation($dateOperation)
    {
        $this->dateOperation = $dateOperation;

        return $this;
    }

    /**
     * Get dateOperation
     *
     * @return \Date
     */
    public function getDateOperation()
    {
        return $this->dateOperation;
    }

    /**
     * Set cotisation
     *
     * @param \Ropi\AuthenticationBundle\Entity\Cotisation $cotisation
     *
     * @return Paiement
     */
    public function setCotisation(\Ropi\AuthenticationBundle\Entity\Cotisation $cotisation = null)
    {
        $this->cotisation = $cotisation;

        return $this;
    }

    /**
     * Get cotisation
     *
     * @return \Ropi\AuthenticationBundle\Entity\Cotisation
     */
    public function getCotisation()
    {
        return $this->cotisation;
    }
}
