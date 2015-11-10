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
            array("En cours d'édition","Quand l'utilisateur clique sur le bouton d'édition du formulaire","null",false,false),
            array("Demande envoyée","Quand l'utilisateur clique sur le bouton VALIDER du formulaire",10,true,true),
            array("Paiement reçu","Quand la réception du paiement a été validée (vérification du mouvement sur le compte, notification paypal?)",3,true,true),
            array("Ordre d'envoi effectué","Quand l'admin a demandé au livreur (bénévole, poste, coursier privé) d'effectuer sa mission de livraison",7,true,false),
            array("Ropi reçu","Lors de la livraison, signature de l'AR par le client ","null",true,false),
            array("Cloture","Quand le livreur notifie l'admin de la livraison en lui rendant la Cc de l'Ar","null",false,true),
        );

        foreach($tab as $element){
            $statut = new Statut();

            $statut->setDescription($element[1]);
            $statut->setNom($element[0]);
            $statut->setDelay($element[2]);
            $statut->setNotifierAdmin($element[3]);
            $statut->setNotifierClient($element[4]);


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