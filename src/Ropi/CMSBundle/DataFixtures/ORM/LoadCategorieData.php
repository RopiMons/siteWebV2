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
use Ropi\CMSBundle\Entity\Categorie;

/**
 * Description of LoadCategorieData
 *
 * @author Laurent Cardon <laurent.cardon@ropi.be>
 */
class LoadCategorieData extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        
        $tab = array(
            array(1,"Accueil",true), //Monopage
            array(2,"Ropi",true),
            array(3,"Commerces",true), //Monopage
            array(4,"Documents",true),
            array(5,"Mon espace Ropi",true),
            array(6,"Zones d'administration",true)
        );
        
        foreach($tab as $element){
            $categorie = new Categorie();
            
            $categorie->setPosition($element[0]);
            $categorie->setNom($element[1]);
            $categorie->setIsActive($element[2]);
            
            $this->setReference("CAT_".$element[0], $categorie);
            
            $manager->persist($categorie);
        }
        
        $manager->flush();
        
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 2; // the order in which fixtures will be loaded
    }

}
