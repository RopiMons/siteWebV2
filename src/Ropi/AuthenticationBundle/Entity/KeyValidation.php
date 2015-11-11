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
     * @var string
     *
     * @ORM\Column(name="validation", type="datetime")
     */
    private $validation;
    /**
     *
     * @ORM\OneToOne(targetEntity="IdentifiantWeb",inversedBy="key", cascade={"persist","remove"})
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
    public function __construct(\Doctrine\ORM\EntityRepository $em, $user) {
        $cleString ="";
        $this->setIdentifiantWeb($user);
        $this->validation = new \DateTime();
        do{
              $cleString = md5(uniqid(null, true).$user->getSalt());
             $validation = $em->findBy(array("cle"=>$cleString));
            
            }while (!isset($validation) && count($validation) <=0);
          
            $this->cle = $cleString;
    }
    
}
