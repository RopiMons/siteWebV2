<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RopiAuthentificationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ropi\AuthenticationBundle\Entity\Role;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of LoadPermissionData
 *
 * @author Adrien Huygens <Adrien.huygens@jsb.be>
 */
class LoadRoleData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        
        $tab = array(
            0 => array("Admin","Ensemble d'autorisations permettant les fonctions administrateurs",$this->getReference("PERM_ROLE_ADMIN")),
            1 => array("Commercant","CRUD des commerces propres",$this->getReference("PERM_ROLE_COMMERCANT")),
            2 => array("UtilisateurAuthentifié","Définis un utilisateur identifié",$this->getReference("PERM_ROLE_UTILISATEUR_ACTIVE")),
             
             );
        
        foreach($tab as $element){
            $role = new Role();
            $role->setNom($element[0]);
            $role->setDescription($element[1]);
            $role->addPermission($element[2]);
            $this->setReference("ROLE_".$element[0], $role);
            $manager->persist($role);
        }
        
        $manager->flush();
        
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 2; // the order in which fixtures will be loaded
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null) {
         $this->container = $container;
    }

}
