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

use Ropi\IdentiteBundle\Entity\Personne;

/**
 * Description of LoadPersonneData
 *
 * @author Laurent Cardon <laurent.cardon@ropi.be>
 */
class LoadPersonneData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        
        $tab = array(
           
            0 => array("Cardon","Laurent",new \DateTime("01-01-1988"), new \DateTime())
             
             );
        
        foreach($tab as $element){
            $personne = new Personne();
            $personne->setNom($element[0]);
            $personne->setPrenom($element[1]);
            $personne->setDateNaissance($element[2]);
            $personne->setCreeLe($element[3]);
            $personne->setIdentifiantWeb($this->getReference('lolo'));
           $this->setReference('loloP', $personne);
            
            $manager->persist($personne);
        }
        
        $manager->flush();
        
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 4; // the order in which fixtures will be loaded
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null) {
         $this->container = $container;
    }

}
