<?php

namespace Ropi\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * IdentifiantWeb
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\AuthenticationBundle\Entity\IdentifiantWebRepository")
 *
 * @ORM\HasLifecycleCallbacks
 * 
 *  UniqueEntity(fields="personne", message="Cette personne a déjà  un compte web")
 * @UniqueEntity(fields="login", message="Ce nom d'utilisateur est déjà utilisé. Merci d'en choisir un autre")
 */
class IdentifiantWeb implements AdvancedUserInterface, \Serializable, EquatableInterface {

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
     * @ORM\Column(name="Username", type="string", length=50)
     *  @Assert\Length(min=3, minMessage="Vous devez avoir un nom d'utilisateur de min {{ limit }} caractères.",
     * max =50, maxMessage="La longeur du nom ne peux pas dépasser {{ limit }} caractères")  
     * @Assert\NotBlank(message="le champs ne peux pas être vide")
     * @Assert\Regex(pattern="/\W/", match = false ,message="La chaine ne peux pas avoir que des Chiffres et des lettres")
     */
    private $username;
    
    /**
     * @var string
     *
     * @ORM\Column(name="motDePasse", type="string", length=255)
     *  @Assert\Length(min=6, minMessage="Votre mot de passe dois avoir au moins {{ limit }} caractères.",
     * max =50, maxMessage="La longeur du mot de passe ne peux pas dépasser {{ limit }} caractères",  groups={"registration"})  
     */
    private $motDePasse;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastConnection", type="datetime",nullable=true)
     */
    private $lastConnection;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createAt", type="datetime")
     */
    private $createAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif;

    /**
     *
     * @var type 
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="identifiantWeb")
     */
    private $roles;

    /**
     *
     * @var type 
     * @ORM\ManyToMany(targetEntity="Permission", inversedBy="identifiantWeb")
     */
    private $permission;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return IdentifiantWeb
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set motDePasse
     *
     * @param string $motDePasse
     * @return IdentifiantWeb
     */
    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    /**
     * Get motDePasse
     *
     * @return string 
     */
    public function getMotDePasse() {
        return $this->motDePasse;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return IdentifiantWeb
     */
    private function setSalt($salt) {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * Set lastConnection
     *
     * @param \DateTime $lastConnection
     * @return IdentifiantWeb
     */
    public function setLastConnection($lastConnection) {
        $this->lastConnection = $lastConnection;

        return $this;
    }

    /**
     * Get lastConnection
     *
     * @return \DateTime 
     */
    public function getLastConnection() {
        return $this->lastConnection;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     * @return IdentifiantWeb
     */
    public function setCreateAt($createAt) {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime 
     */
    public function getCreateAt() {
        return $this->createAt;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return IdentifiantWeb
     */
    public function setActif($actif) {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean 
     */
    public function getActif() {
        return $this->actif;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->salt = md5(uniqid(null, true));
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Permission = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add roles
     *
     * @param \Ropi\AuthenticationBundle\Entity\Role $roles
     * @return IdentifiantWeb
     */
    public function addRole(\Ropi\AuthenticationBundle\Entity\Role $roles) {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \Ropi\AuthenticationBundle\Entity\Role $roles
     */
    public function removeRole(\Ropi\AuthenticationBundle\Entity\Role $roles) {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles() {
        //return $this->roles;

        return array('ROLE_ADMIN',);
    }

    /**
     * Add Permission
     *
     * @param \Ropi\AuthenticationBundle\Entity\Permission $permission
     * @return IdentifiantWeb
     */
    public function addPermission(\Ropi\AuthenticationBundle\Entity\Permission $permission) {
        $this->Permission[] = $permission;

        return $this;
    }

    /**
     * Remove Permission
     *
     * @param \Ropi\AuthenticationBundle\Entity\Permission $permission
     */
    public function removePermission(\Ropi\AuthenticationBundle\Entity\Permission $permission) {
        $this->Permission->removeElement($permission);
    }

    /**
     * Get Permission
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPermission() {
        return $this->Permission;
    }

    public function eraseCredentials() {
        
    }

    public function getPassword() {
        return $this->motDePasse;
    }

    public function isAccountNonExpired() {
        return true;
    }

    public function isAccountNonLocked() {
        return true;
    }

    public function isCredentialsNonExpired() {
        return true;
    }

    public function isEnabled() {
        return $this->actif;
    }

    public function isEqualTo(\Symfony\Component\Security\Core\User\UserInterface $user) {
        return $this->username === $user->getUsername();
    }

    public function serialize() {
        return serialize(array(
            $this->id, $this->username, $this->motDePasse,
        ));
    }

    public function unserialize($serialized) {
        list (
                $this->id, $this->username, $this->motDePasse,
                ) = unserialize($serialized);
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist() {
        if (!isset($this->actif)) {
            $this->actif = true;
        }
        $this->setCreateAt(new \DateTime());
    }

}
