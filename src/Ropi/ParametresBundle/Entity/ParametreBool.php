<?php

namespace Ropi\ParametresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ropi\ParametresBundle\Entity\Parametre;

/**
 * ParametreBool
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\ParametresBundle\Entity\ParametreBool�Repository")
 */
class ParametreBool extends Parametre
{

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isKernel", type="boolean")
     */
    private $isKernel;


    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return ParametreBool
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isKernel
     *
     * @param boolean $isKernel
     * @return ParametreBool
     */
    public function setIsKernel($isKernel)
    {
        $this->isKernel = $isKernel;

        return $this;
    }

    /**
     * Get isKernel
     *
     * @return boolean 
     */
    public function getIsKernel()
    {
        return $this->isKernel;
    }
}
