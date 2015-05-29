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
        $tab["Home"] = array('route' => 'home');
        $tab["Gestion CMS"]['Création de pages'] =  array('route' => 'CMS_static_create');
        $tab["Gestion CMS"]['Gestion des pages'] =  array('route' => 'CMS_pages');
        $tab["Administration"]["Accueil"] = array('route' => 'admin_home');
        $tab["Administration"]["Gestion des commerces"] = array('route' => 'admin_commerces');
    
        return $tab;

                
    }

}
