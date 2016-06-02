<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ropi\ParametresBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Ropi\ParametresBundle\Entity\Parametre;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadParametreConcretData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        
        $tab = array(
           
            0 => array("compteCourant","BE20 5230 8074 0956","Compte courant de l'ASBL Ropi"),
            1 => array("compteFondGarantie","BE29 5230 4710 2164","Fonds de garantie de l'ASBL Ropi"),
            2 => array("cotisationUsagerEuro","15","Montant de la cotisation d'un usager en Euro €"),
            3 => array("cotisationUsagerRopi","10","Montant de la cotisation d'un usager en Ropi R"),
            4 => array("adresseSiegeSocial","Rue de Ghlin, 24 - 7012 Jemappes","Adresse du siège sociale de l'ASBL Ropi"),
            5 => array("cotisationAssociationEuro","20","Montant de la cotisation d'une association en Euro €"),
            6 => array("cotisationAssociationRopi","15","Montant de la cotisation d'une association en Ropi R"),
            7 => array("cotisationPrestataireEuro","25","Montant de la cotisation d'un prestataire en Euro €"),
            8 => array("cotisationPrestataireRopi","20","Montant de la cotisation d'un prestataire en Ropi R"),
            9 => array("taxeReconversion","5","Taxe de reconversion de Ropi en Euro en %"),
            10 => array("trancheReconversionNullePrestataire","200","Tranche de reconversion 0 % d'un prestataire en Euro €"),
            11 => array("trancheReconversionNulleAssociation","100","Tranche de reconversion 0 % d'une association en Euro € "),
            12 => array("emailInfo","info@ropi.be","Email d'information générale"),
            13 => array("emailSupport","support@ropi.be","Email de support pour les prestataires"),

             
             );
        
        foreach($tab as $element){
            $objet = new Parametre();

            $objet->setNom($element[0]);
            $objet->setValeur($element[1]);
            $objet->setDescription($element[2]);

            $manager->persist($objet);
        }
        
        $manager->flush();
        
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 1; // the order in which fixtures will be loaded
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null) {
         $this->container = $container;
    }

}
