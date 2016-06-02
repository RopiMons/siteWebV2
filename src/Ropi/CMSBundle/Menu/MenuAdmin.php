<?php

/*
 * Copyright 2015 Version 1.0.0
 * Pour le Pass, projet gestion de log.
 * @author Huygens Adrien
 * contact adrien.huygens@gmail.com
 */

namespace Ropi\CMSBundle\Menu;


use Knp\Menu\FactoryInterface;
use Ropi\CMSBundle\Entity\PositionnableInterface;

class MenuAdmin extends AbstractMenu {

    protected function tableau() {
        $tab = array();
        $tab["Home"] = array('route' => 'CMS_pages');
        $tab["Gestion CMS"]['Gestion des pages'] =  array('route' => 'CMS_pages');
        $tab["Gestion CMS"]['Création de pages'] =  array('route' => 'CMS_static_create');
        $tab["Gestion CMS"]["Création d'une catégorie"] =  array('route' => 'CMS_categorie_create');
        $tab["Administration"]["Accueil"] = array('route' => 'admin_home');
        $tab["Administration"]["Gestion des commerces"] = array('route' => 'admin_commerces');
        $tab["Mon commerces"]["Créer un nouveau commerce"] = array('route'=>'commerce_new');
        $tab["News"]["Les news"] = array('route'=>'iola_corporation_news_show');
        $tab["News"]["Ajouter"] = array('route'=>'iola_corporation_news_add');
        $tab["Utilisateurs"]["liste"] =  array('route'=>'Ropi_admin_user_listing');
        $tab["Utilisateurs"]["Ajouter un membre"] =  array('route'=>'Ropi_admin_user_add');
    
        return $tab;

                
    }

}
