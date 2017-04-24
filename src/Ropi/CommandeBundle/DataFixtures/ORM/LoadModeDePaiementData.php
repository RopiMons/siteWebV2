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
use Ropi\CommandeBundle\Entity\ModeDePaiement;


class LoadModeDePaiementData extends AbstractFixture implements OrderedFixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {

        $tab = array(
            array("Virement","Paiement par virement bancaire via votre organisme financier (munisez vous de votre digipass ou autre système demandé par votre organisme financier)",0,"image",null,"virementConfirmation"),
            array("Paypal","Paiement par Paypal auquel vous devez être préalablement enregistré.","((X+0.35)/(1-0.034))-X","image",null,null),
            array("Ropi électronique","Paiement en ropis par le système Ropi Banking",0,"image",null,null),
            array("Cash","Paiement en espèce (ropis ou euros) à donner au livreur. N'est possible que si la livraison est effectuée par un livreur de l'asbl.",2,"image",null,null)
        );

        foreach($tab as $element){
            $mode = new ModeDePaiement();

            $mode->setNom($element[0]);
            $mode->setImage($element[3]);
            $mode->setDescription($element[1]);
            $mode->setActif(true);
            $mode->setFrais($element[2]);
            $mode->setRedirection($element[4]);
            $mode->setConfirmation($element[5]);

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