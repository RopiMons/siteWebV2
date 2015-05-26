<?php

namespace Ropi\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KeyValidation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class KeyValidation
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
     * @ORM\Column(name="cle", type="string", length=255)
     */
    private $cle;
    /**
     *
     * @ORM\OneToOne(targetEntity="IdentifiantWeb")
     */
    
    private $IdentifiantWeb;

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
     * Set cle
     *
     * @param string $cle
     * @return KeyValidation
     */
    public function setCle($cle)
    {
        $this->cle = $cle;

        return $this;
    }

    /**
     * Get cle
     *
     * @return string 
     */
    public function getCle()
    {
        return $this->cle;
    }

    /**
     * Set IdentifiantWeb
     *
     * @param \Ropi\AuthenticationBundle\Entity\IdentifiantWeb $identifiantWeb
     * @return KeyValidation
     */
    public function setIdentifiantWeb(\Ropi\AuthenticationBundle\Entity\IdentifiantWeb $identifiantWeb = null)
    {
        $this->IdentifiantWeb = $identifiantWeb;

        return $this;
    }

    /**
     * Get IdentifiantWeb
     *
     * @return \Ropi\AuthenticationBundle\Entity\IdentifiantWeb 
     */
    public function getIdentifiantWeb()
    {
        return $this->IdentifiantWeb;
    }
}
