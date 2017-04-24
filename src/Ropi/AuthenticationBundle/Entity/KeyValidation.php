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
    * @ORM\Column(name="cle", type="string", length=255)
    */
    private $cle;
    /**
     * @var string
     *
     * @ORM\Column(name="validation", type="datetime")
     */
    private $validation;

    /**
     * @var string
     *

    /**
     * @var integer
     *
     * @ORM\Column(name="id_identifiantWeb", type="integer")
     */
    
    private $id_identifiantWeb;

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
    public function setIdentifiantWeb($identifiantWeb = null)
    {
        $this->id_identifiantWeb = $identifiantWeb;

        return $this;
    }

    /**
     * Get IdentifiantWeb
     *
     * @return \Ropi\AuthenticationBundle\Entity\IdentifiantWeb 
     */
    public function getIdentifiantWeb()
    {
        return $this->id_identifiantWeb;
    }

    /**
     * Set validation
     *
     * @param \DateTime $validation
     * @return KeyValidation
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;

        return $this;
    }

    /**
     * Get validation
     *
     * @return \DateTime 
     */
    public function getValidation()
    {
        return $this->validation;
    }
    public function __construct($salt) {
        $cleString ="";
        //$this->setIdentifiantWeb($user);

        $this->validation = new \DateTime();

              $cleString = md5(uniqid(null, true).$salt);

            

          
            $this->cle = $cleString;
    }
    

    /**
     * Set id_identifiantWeb
     *
     * @param integer $idIdentifiantWeb
     * @return KeyValidation
     */
    public function setIdIdentifiantWeb($idIdentifiantWeb)
    {
        $this->id_identifiantWeb = $idIdentifiantWeb;

        return $this;
    }

    /**
     * Get id_identifiantWeb
     *
     * @return integer 
     */
    public function getIdIdentifiantWeb()
    {
        return $this->id_identifiantWeb;
    }
}
