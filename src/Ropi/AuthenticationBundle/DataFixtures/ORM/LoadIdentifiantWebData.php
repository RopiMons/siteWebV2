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
use Ropi\AuthenticationBundle\Entity\IdentifiantWeb;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of LoadPermissionData
 *
 * @author Adrien Huygens <Adrien.huygens@jsb.be>
 */
class LoadIdentifiantWebData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        
        $tab = array(
            0 => array("Adrien","abcde"),
              1 => array("Fabian","@Bcde1"),
              2 => array("Laurent5","admin"),
              3 => array("Joelle","abcde"),
             );
        
        foreach($tab as $element){
            $identifiant = new IdentifiantWeb();
            $identifiant->setUsername($element[0]);
            $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($identifiant)
        ;
            
             $identifiant->setMotDePasse($encoder->encodePassword($element[1], $identifiant->getSalt()));
            //$this->setReference("PERM_".$element[0], $permission);
            $identifiant->setActif(true);
            $manager->persist($identifiant);
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
