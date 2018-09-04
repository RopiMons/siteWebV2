<?php

namespace Ropi\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ropi\AuthenticationBundle\Entity\Permission;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Ropi\CMSBundle\Entity\PositionnableInterface;

/**
 * Page
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ropi\CMSBundle\Repository\PageRepository")
 * 
 * @ORM\MappedSuperclass
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"dynamique"="PageDynamique", "statique"="PageStatique"})
 * 
 * @ORM\HasLifecycleCallbacks()
 * 
 * @UniqueEntity(fields={"titreMenu"}, message="Ce titre est déjà présent dans le menu")
 * 
 */
abstract class Page implements PositionnableInterface {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="titreMenu", type="string", length=25)
     * @Assert\Length(min="3", max="25")
     * 
     */
    private $titreMenu;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastUpdate", type="datetime")
     */
    private $lastUpdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publicationDate", type="datetime")
     */
    private $publicationDate;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="pages")
     */
    private $categorie;
    
    /**
     *
     * @ORM\ManyToMany(targetEntity="Ropi\AuthenticationBundle\Entity\Permission", inversedBy="pages")
     */
    private $permissions;
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Page
     */
    public function setPosition($position) {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * Set titreMenu
     *
     * @param string $titreMenu
     * @return Page
     */
    public function setTitreMenu($titreMenu) {
        $this->titreMenu = $titreMenu;

        return $this;
    }

    /**
     * Get titreMenu
     *
     * @return string 
     */
    public function getTitreMenu() {
        return $this->titreMenu;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Page
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     * @return Page
     */
    public function setLastUpdate($lastUpdate) {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get lastUpdate
     *
     * @return \DateTime 
     */
    public function getLastUpdate() {
        return $this->lastUpdate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Page
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set publicationDate
     *
     * @param \DateTime $publicationDate
     * @return Page
     */
    public function setPublicationDate($publicationDate) {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate
     *
     * @return \DateTime 
     */
    public function getPublicationDate() {
        return $this->publicationDate;
    }
    
    abstract function getRoute();
    abstract function getParametres();
    abstract function getURIArray();

    /**
     * @ORM\PrePersist()
     */
    public function onPrePersist() {
        $now = new \DateTime();
        $this->setCreatedAt($now);
        $this->setLastUpdate($now);

        if (!isset($this->isActive)) {
            $this->isActive = false;
        }
    }

    /**
     * Set categorie
     *
     * @param \Ropi\CMSBundle\Entity\Categorie $categorie
     * @return Page
     */
    public function setCategorie(\Ropi\CMSBundle\Entity\Categorie $categorie = null) {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Ropi\CMSBundle\Entity\Categorie 
     */
    public function getCategorie() {
        return $this->categorie;
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate() {
        $this->lastUpdate = new \DateTime();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->permission = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add permissions
     *
     * @param \Ropi\AuthenticationBundle\Entity\Permission $permissions
     * @return Page
     */
    public function addPermission(\Ropi\AuthenticationBundle\Entity\Permission $permissions)
    {
        $this->permissions[] = $permissions;

        return $this;
    }

    /**
     * Remove permissions
     *
     * @param \Ropi\AuthenticationBundle\Entity\Permission $permissions
     */
    public function removePermission(\Ropi\AuthenticationBundle\Entity\Permission $permissions)
    {
        $this->permissions->removeElement($permissions);
    }

    /**
     * Get permissions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    public function hasPermission(Permission $permission){
        return $this->getPermissions()->contains($permission);
    }

    public function hasPermissions($tab){
        foreach($tab as $element){
            if($this->getPermissions()->contains($element)){
                return true;
            }
        }
        return false;
    }

    public function hasPermissionString ($permission){
        $trouve = false;
        foreach ( $this->getPermissions() as $perm) {
            if($perm->getPermission() == $permission){
                $trouve = true;
                break;
            }
        }
        return $trouve;
    }

    public function hasPermissionsString ($tab){
        $trouve = false;
        foreach($tab as $el){
            if($this->hasPermission($el)){
                $trouve = true;
                break;
            }
        }
        return $trouve;
    }
}
