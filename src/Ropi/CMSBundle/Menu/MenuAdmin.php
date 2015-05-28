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

   
    

    


   public function AdminMenu()
    {
         $menu = $this->factory->createItem('root');
        



        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', ' nav navbar-nav');
        $menu->addChild('Home', array('route' => 'home'));


          $menu->addChild('CMS',array('uri'=>'#','label'=>'Gestion CMS ▼'))->setAttribute('class', 'dropdown');
          $menu['CMS']->setLinkAttribute('class', 'dropdown-toggle');
          $menu['CMS']->setLinkAttribute('role', 'button');
          $menu['CMS']->setLinkAttribute('data-toggle', 'dropdown');
          $menu['CMS']->setChildrenAttribute('role', 'menu');
          $menu['CMS']->setChildrenAttribute('class', 'dropdown-menu');

          $menu['CMS']->addChild('Création de pages', array('route' => 'CMS_static_create'))->setAttribute('divider_append', true);

          $menu['CMS']->addChild('Gestion des pages', array('route' => 'CMS_pages'));

         $menu->addChild('Admin',array('uri'=>'#','label'=>'Administration ▼'))->setAttribute('class', 'dropdown');
          $menu['Admin']->setLinkAttribute('class', 'dropdown-toggle');
          $menu['Admin']->setLinkAttribute('role', 'button');
          $menu['Admin']->setLinkAttribute('data-toggle', 'dropdown');
          $menu['Admin']->setChildrenAttribute('role', 'menu');
          $menu['Admin']->setChildrenAttribute('class', 'dropdown-menu');

          $menu['Admin']->addChild('Accueil', array('route' => 'admin_home'))->setAttribute('divider_append', true);
         





        //$menu->addChild('Accueil', array('route' => 'home'));



        /*
          $menu->addChild('Gestion log', array('route' => 'home'));


          $menu->addChild('Admin',array('uri'=>'#','label'=>'Administration ▼'))->setAttribute('class', 'dropdown');
          $menu['Admin']->setLinkAttribute('class', 'dropdown-toggle');
          $menu['Admin']->setLinkAttribute('role', 'button');
          $menu['Admin']->setLinkAttribute('data-toggle', 'dropdown');
          $menu['Admin']->setChildrenAttribute('role', 'menu');
          $menu['Admin']->setChildrenAttribute('class', 'dropdown-menu');

          $menu['Admin']->addChild('Gestion Utilisateurs', array('route' => 'home'))->setAttribute('divider_append', true);

          $menu['Admin']->addChild('Gestion Groupes', array('route' => 'home'));

          $menu['Admin']->addChild('Gestion Groupes d\'ordinateurs', array('route' => 'home'));
          //$menu['Admin']->addChild('Gestion Role', array('uri' => '#'));
          $menu['Admin']->addChild('Statistiques', array('route' => 'home'));









          // access services from the container!

          //$em = $this->container->get('doctrine')->getManager();
          // findMostRecent and Blog are just imaginary examples
          // $blog = $em->getRepository('AppBundle:Blog')->findMostRecent();

          //$menu->addChild('Latest Blog Post', array(
          //   'route' => 'blog_show',
          //  'routeParameters' => array('id' => $blog->getId())
          // ));

          // you can also add sub level's to your menu's as follows
          // $menu['About Me']->addChild('Edit profile', array('route' => 'edit_profile'));

          // ... add more children
         */
        return $menu;
    }


    protected function tableau() {
        $tab = array();
        $tab["Home"] = array('route' => 'home');
        $tab["Gestion CMS"]['Création de pages'] =  array('route' => 'CMS_static_create');
         $tab["Gestion CMS"]['Gestion des pages'] =  array('route' => 'CMS_pages');
    
        return $tab;

                
    }

}
