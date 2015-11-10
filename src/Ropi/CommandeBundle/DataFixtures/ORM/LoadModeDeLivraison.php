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
use Ropi\CommandeBundle\Entity\ModeDeLivraison;


class LoadModeDeLivraisonData extends AbstractFixture implements OrderedFixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {

        $tab = array(
            array("nom","description","frais","image")
        );

        foreach($tab as $element){
            $mode = new ModeDeLivraison();

            $mode->setNom($tab[0]);
            $mode->setImage($tab[3]);
            $mode->setDescription($tab[1]);
            $mode->setActif(true);
            $mode->setFrais($tab[2]);
            $mode->setRedirection("test");

            $manager->persist($mode);

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