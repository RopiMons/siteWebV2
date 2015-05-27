<?php

namespace Ropi\IdentiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeMoyenContact
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Ropi\IdentiteBundle\Entity\TypeMoyenContactRepository")
 */
class TypeMoyenContact
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
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="obligatoire", type="boolean")
     */
    private $obligatoire;

    /**
     * @var boolean
     *
     * @ORM\Column(name="proposeInscription", type="boolean")
     */
    private $proposeInscription;

    /**
     * @var string
     *
     * @ORM\Column(name="validateur", type="string", length=50)
     */
    private $validateur;


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
     * Set type
     *
     * @param string $type
     * @return TypeMoyenContact
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set obligatoire
     *
     * @param boolean $obligatoire
     * @return TypeMoyenContact
     */
    public function setObligatoire($obligatoire)
    {
        $this->obligatoire = $obligatoire;

        return $this;
    }

    /**
     * Get obligatoire
     *
     * @return boolean 
     */
    public function getObligatoire()
    {
        return $this->obligatoire;
    }

    /**
     * Set proposeInscription
     *
     * @param boolean $proposeInscription
     * @return TypeMoyenContact
     */
    public function setProposeInscription($proposeInscription)
    {
        $this->proposeInscription = $proposeInscription;

        return $this;
    }

    /**
     * Get proposeInscription
     *
     * @return boolean 
     */
    public function getProposeInscription()
    {
        return $this->proposeInscription;
    }

    /**
     * Set validateur
     *
     * @param string $validateur
     * @return TypeMoyenContact
     */
    public function setValidateur($validateur)
    {
        $this->validateur = $validateur;

        return $this;
    }

    /**
     * Get validateur
     *
     * @return string 
     */
    public function getValidateur()
    {
        return $this->validateur;
    }
    public function __toString() {
        return $this->type;
    }
}
