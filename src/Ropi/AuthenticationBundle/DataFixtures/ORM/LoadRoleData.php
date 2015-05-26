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
            0 => array("Admin","Je suis un groupe Admin"),
             
             );
        
        foreach($tab as $element){
            $role = new Role();
            $role->setNom($element[0]);
            $role->setDescription($element[1]);
            $manager->persist($role);
        }
        
        $manager->flush();
        
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 1; // the order in which fixtures will be loaded
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null) {
         $this->container = $container;
    }

}
