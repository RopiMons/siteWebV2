<?php

namespace Ropi\ParametresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ropi\ParametresBundle\Entity\Parametre;

/**
 * ParametreConcret
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\ParametresBundle\Entity\ParametreConcretRepository")
 */
class ParametreConcret extends Parametre
{

    /**
     * @var string
     *
     * @ORM\Column(name="valeur", type="string", length=255)
     */
    private $valeur;

    /**
     * Set valeur
     *
     * @param string $valeur
     * @return ParametreConcret
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return string 
     */
    public function getValeur()
    {
        return $this->valeur;
    }
}
