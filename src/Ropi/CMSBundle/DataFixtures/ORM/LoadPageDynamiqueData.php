<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Ropi\CMSBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ropi\CMSBundle\Entity\PageDynamique;
USE DateTime;
/**
 * Description of LoadPageDynamiqueData
 *
 * @author Laurent Cardon <laurent.cardon@ropi.be>
 */
class LoadPageDynamiqueData extends AbstractFixture implements OrderedFixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        $tab = array(
            array(1, "Nos commerçants", true, new \DateTime("2015-05-26 13:48:41"), new \DateTime("2015-05-26 13:48:41"), new \DateTime("2015-01-01 00:00:00"), $this->getReference("CAT_3"), "commerces", array($this->getReference("PERM_ROLE_ANONYME"),$this->getReference("PERM_ROLE_UTILISATEUR_ACTIVE"),$this->getReference("PERM_ROLE_CMS_CREATE"))),
            array(1, "Accueil", 1, new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_1"), "home", array($this->getReference("PERM_ROLE_ANONYME"),$this->getReference("PERM_ROLE_UTILISATEUR_ACTIVE"),$this->getReference("PERM_ROLE_CMS_CREATE"))),
            array(1, "Se connecter", 1, new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_5"), "login", array($this->getReference("PERM_ROLE_ANONYME"))),
            array(2, "S'inscrire", 1, new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_5"), "ropi_inscription", array($this->getReference("PERM_ROLE_ANONYME"))),
            array(3, "Acheter des Ropi", 1, new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_5"), "commande_new" ,array($this->getReference("PERM_ROLE_UTILISATEUR_ACTIVE"),$this->getReference("PERM_ROLE_CMS_CREATE"),$this->getReference("PERM_ROLE_ADMIN"))),
            array(4, "Ajouter mon commerce", 1, new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_5"), "commerce_new", array($this->getReference("PERM_ROLE_COMMERCANT"),$this->getReference("PERM_ROLE_UTILISATEUR_ACTIVE"))),
            array(5, "Me déconnecter", 1, new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_5"), "logout", array($this->getReference("PERM_ROLE_ADMIN"),$this->getReference("PERM_ROLE_CMS_CREATE"),$this->getReference("PERM_ROLE_COMMERCANT"),$this->getReference("PERM_ROLE_UTILISATEUR_ACTIVE"))),
            array(1, "Zone CMS", 1, new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_6"), "CMS_pages", array($this->getReference("PERM_ROLE_ADMIN"),$this->getReference("PERM_ROLE_CMS_CREATE"))),
            array(2, "Zone Admin", 1, new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_6"), "admin_home", array($this->getReference("PERM_ROLE_ADMIN"))),
            array(3, "Zone Admin commerces", 1, new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-05-27T20:39:18+02:00"), new DateTime("2015-01-01T00:00:00+01:00"), $this->getReference("CAT_6"), "admin_commerces", array($this->getReference("PERM_ROLE_ADMIN")))
        );
        foreach ($tab as $element) {
            $page = new PageDynamique();
            $page->setPosition($element[0]);
            $page->setTitreMenu($element[1]);
            $page->setIsActive($element[2]);
            $page->setLastUpdate($element[3]);
            $page->setCreatedAt($element[4]);
            $page->setPublicationDate($element[5]);
            $page->setCategorie($element[6]);
            $page->setRoute($element[7]);
            foreach($element[8] as $perm){
                $page->addPermission($perm);
            }
            $manager->persist($page);
        }
        $manager->flush();
    }
    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 3; // the order in which fixtures will be loaded
    }
}