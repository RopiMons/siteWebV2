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

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of LoadPermissionData
 *
 * @author Adrien Huygens <Adrien.huygens@jsb.be>
 */
class LoadAdresseData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        
        $tab = array(
           
            0 => array("rue de la pizza",1,$this->getReference("PizzaLand"),$this->getReference("Domicile"),$this->getReference("loloP")),

             
             );
        
        foreach($tab as $element){
            $type = new \Ropi\IdentiteBundle\Entity\Adresse();
            $type->setRue($element[0]);
            $type->setNumero($element[1]);
            $type->setTypeAdresse($element[3]);
            $type->setVille($element[2]);
            $type->addPersonne($element[4]);
            $manager->persist($type);
            $this->setReference($element[0],$type);
        }
        
        $manager->flush();
        
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 7; // the order in which fixtures will be loaded
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null) {
         $this->container = $container;
    }

}
