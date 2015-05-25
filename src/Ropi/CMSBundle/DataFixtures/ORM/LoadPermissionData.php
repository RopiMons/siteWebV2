<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace JSBTrajetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ropi\AuthenticationBundle\Entity\Permission;

/**
 * Description of LoadPermissionData
 *
 * @author Laurent Cardon <laurent.cardon@ropi.be>
 */
class LoadPermissionData extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        
        $tab = array(
            0 => array("ROLE_CMS_CREATE","Créer une page avec le CMS","Autorise la personne qui possède cette autorisation à créer une nouvelle page dans le système de CMS"),
             );
        
        foreach($tab as $element){
            $permission = new Permission();
            
            $permission->setNom($element[1]);
            $permission->setDescription($element[2]);
            $permission->setPermission($element[0]);
            
            $this->setReference("PERM_".$element[0], $permission);
            
            $manager->persist($permission);
        }
        
        $manager->flush();
        
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 1; // the order in which fixtures will be loaded
    }

}
