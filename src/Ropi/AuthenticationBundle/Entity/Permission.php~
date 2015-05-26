<?php

namespace Ropi\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permission
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\AuthenticationBundle\Entity\PermissionRepository")
 */
class Permission
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
     * @var string
     *
     * @ORM\Column(name="permission", type="string", length=100)
     */
    private $permission;

     /**
     *
     * @var type 
     * @ORM\ManyToMany(targetEntity="Role", mappedBy="permission")
     */
    private $roles;
        
     /**
     *
     * @var type 
     * @ORM\ManyToMany(targetEntity="IdentifiantWeb", mappedBy="permission")
     */
    private $identifiantWeb;

   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->identifiantWeb = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Permission
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
     * @return Permission
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
     * Set permission
     *
     * @param string $permission
     * @return Permission
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get permission
     *
     * @return string 
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Add roles
     *
     * @param \Ropi\AuthenticationBundle\Entity\Role $roles
     * @return Permission
     */
    public function addRole(\Ropi\AuthenticationBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \Ropi\AuthenticationBundle\Entity\Role $roles
     */
    public function removeRole(\Ropi\AuthenticationBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Add identifiantWeb
     *
     * @param \Ropi\AuthenticationBundle\Entity\identifiantWeb $identifiantWeb
     * @return Permission
     */
    public function addIdentifiantWeb(\Ropi\AuthenticationBundle\Entity\identifiantWeb $identifiantWeb)
    {
        $this->identifiantWeb[] = $identifiantWeb;

        return $this;
    }

    /**
     * Remove identifiantWeb
     *
     * @param \Ropi\AuthenticationBundle\Entity\identifiantWeb $identifiantWeb
     */
    public function removeIdentifiantWeb(\Ropi\AuthenticationBundle\Entity\identifiantWeb $identifiantWeb)
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
    public function __toString() {
        return $this->nom;
    }
}
