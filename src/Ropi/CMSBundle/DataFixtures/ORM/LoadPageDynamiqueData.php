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
use Ropi\CMSBundle\Entity\PageDynamique;
USE DateTime;

/**
 * Description of LoadPageDynamiqueData
 *
 * @author Laurent Cardon <laurent.cardon@ropi.be>
 */
class LoadPageDynamiqueData extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {

        $tab = array(
            array(1, "Nos commerçants", true, new \DateTime("2015-05-26 13:48:41"), new \DateTime("2015-05-26 13:48:41"), new \DateTime("2015-01-01 00:00:00"), $this->getReference("CAT_3"), "commerces" ),
                );

        foreach ($tab as $element) {
            $page = new PageDynamique();

            $page->setPosition($element[0]);
            $page->setTitreMenu($element[1]);
            $page->setIsActive($element[2]);
            $page->setLastUpdate($element[3]);
            $page->setCreatedAt($element[4]);
            $page->setPublicationDate($element[5]);
            $page->setCategorie($element[6]);
            $page->setRoute($element[7]);

            $manager->persist($page);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 3; // the order in which fixtures will be loaded
    }

}
