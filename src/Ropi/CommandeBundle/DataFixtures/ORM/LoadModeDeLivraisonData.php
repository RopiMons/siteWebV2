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
            array("Poste (Belgique)","La commande sera livrée par la poste avec accusé de réception et garantie en cas de perte. Partout en Belgique.",10,"image","/^\d{4}$/",true),
            array("Le coursier montois","La commande sera livrée par un coursier montois. Ce mode de livraison couvre les entités 7000",4,"image", "/^7000$/",true),
            array("Livreur de l'asbl","La commande sera livrée par un livreur de l'asbl Ropi. Ce mode de livraison est limitée à 7000 Mons",5,"image","/^7000|7011|7012|7020|7021|7033|7034|7050$/",true),
            array("Dépôt chez un commerçant","La commande sera livrée chez un commerçant membre de l'asbl ropi (au choix)",0,"image","",false)
        );

        foreach($tab as $element){

            $mode = new ModeDeLivraison();

            $mode->setNom($element[0]);
            $mode->setImage($element[3]);
            $mode->setDescription($element[1]);
            $mode->setActif(true);
            $mode->setFrais($element[2]);
            $mode->setRegleCP($element[4]);
            $mode->setADomicile($element[5]);

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