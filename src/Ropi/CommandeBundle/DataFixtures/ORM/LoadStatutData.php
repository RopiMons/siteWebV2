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
use Ropi\CommandeBundle\Entity\Statut;

/**
 * Description of LoadCategorieData
 *
 * @author Laurent Cardon <laurent.cardon@ropi.be>
 */
class LoadStatutData extends AbstractFixture implements OrderedFixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {

        $tab = array(
            array("nom","description","Delais","Notifier Client","Notifier Admin"),
        );

        foreach($tab as $element){
            $statut = new Statut();

            $statut->setDescription($tab[1]);
            $statut->setNom($tab[0]);
            $statut->setDelay($tab[2]);
            $statut->setNotifierAdmin($tab[3]);
            $statut->setNotifierClient($tab[4]);


            $manager->persist($statut);
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