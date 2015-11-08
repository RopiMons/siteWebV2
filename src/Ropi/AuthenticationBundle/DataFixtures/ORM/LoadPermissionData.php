<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ropi\AuthenticationBundle\DataFixtures\ORM;

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
            1 => array("ROLE_ADMIN","Administrateur","Donne l'access total à l'administration"), 
            2 => array("ROLE_COMMERCANT","Commercant enregistré", "Permet de réaliser le CRUD sur les commerces propres"),
            3 => array("ROLE_UTILISATEUR_ACTIVE","Utilisateur activé","Permet de distingué un utilisateur authentifié"),
            4 => array("ROLE_ANONYME","Visiteur Anonyme","Permet de distingué un visiteur non authentifié du site"),
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
