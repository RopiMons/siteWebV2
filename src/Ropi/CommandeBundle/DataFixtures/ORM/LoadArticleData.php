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
use Ropi\CommandeBundle\Entity\Article;

/**
 * Description of LoadCategorieData
 *
 * @author Laurent Cardon <laurent.cardon@ropi.be>
 */
class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {

        $tab = array(
            array("billet de 0.5 Ropi","Il s'aggit d'une coupure de 0.5 R", 0.5, 1000),
            array("billet de 1 Ropi","Il s'aggit d'une coupure de 1 R", 1, 1000),
            array("billet de 5 Ropi","Il s'aggit d'une coupure de 5 R", 5, 1000),
            array("billet de 10 Ropi","Il s'aggit d'une coupure de 5 R", 10, 1000),
        );

        foreach($tab as $element){
            $article = new Article();

            $article->setDescription($tab[1]);
            $article->setImage("test");
            $article->setNom($tab[0]);
            $article->setPrix($tab[2]);
            $article->setStock($tab[3]);

            $manager->persist($article);
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