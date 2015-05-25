<?php

namespace Ropi\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\AuthenticationBundle\Entity\RoleRepository")
 */
class Role
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
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
     /**
     *
     * @var identifiantWeb
     * @ORM\ManyToMany(targetEntity="IdentifiantWeb", mappedBy="roles")
     */
    private $identifiantWeb;
    
     /**
     *
     * @var type 
     * @ORM\ManyToMany(targetEntity="Permission", inversedBy="roles")
     */
    private $permission;

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
     * Set nom
     *
     * @param string $nom
     * @return Role
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Role
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->identifiantweb = new \Doctrine\Common\Collections\ArrayCollection();
        $this->permission = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add permission
     *
     * @param \Ropi\AuthenticationBundle\Entity\Permission $permission
     * @return Role
     */
    public function addPermission(\Ropi\AuthenticationBundle\Entity\Permission $permission)
    {
        $this->permission[] = $permission;

        return $this;
    }

    /**
     * Remove permission
     *
     * @param \Ropi\AuthenticationBundle\Entity\Permission $permission
     */
    public function removePermission(\Ropi\AuthenticationBundle\Entity\Permission $permission)
    {
        $this->permission->removeElement($permission);
    }

    /**
     * Get permission
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Add identifiantWeb
     *
     * @param \Ropi\AuthenticationBundle\Entity\IdentifiantWeb $identifiantWeb
     * @return Role
     */
    public function addIdentifiantWeb(\Ropi\AuthenticationBundle\Entity\IdentifiantWeb $identifiantWeb)
    {
        $this->identifiantWeb[] = $identifiantWeb;

        return $this;
    }

    /**
     * Remove identifiantWeb
     *
     * @param \Ropi\AuthenticationBundle\Entity\IdentifiantWeb $identifiantWeb
     */
    public function removeIdentifiantWeb(\Ropi\AuthenticationBundle\Entity\IdentifiantWeb $identifiantWeb)
    {
        $this->identifiantWeb->removeElement($identifiantWeb);
    }

    /**
     * Get identifiantWeb
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdentifiantWeb()
    {
        return $this->identifiantWeb;
    }
}
