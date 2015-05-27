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

class MenuAdmin {

   
    
private $factory;
    

    public function __construct(FactoryInterface $factory) {
        $this->factory = $factory;
     
    }

   public function AdminMenu()
    {
         $menu = $this->factory->createItem('root');
        



        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', ' nav navbar-nav');
        $menu->addChild('Home', array('route' => 'home'));


          $menu->addChild('Admin',array('uri'=>'#','label'=>'Gestion CMS ▼'))->setAttribute('class', 'dropdown');
          $menu['Admin']->setLinkAttribute('class', 'dropdown-toggle');
          $menu['Admin']->setLinkAttribute('role', 'button');
          $menu['Admin']->setLinkAttribute('data-toggle', 'dropdown');
          $menu['Admin']->setChildrenAttribute('role', 'menu');
          $menu['Admin']->setChildrenAttribute('class', 'dropdown-menu');

          $menu['Admin']->addChild('Création de pages', array('route' => 'CMS_static_create'))->setAttribute('divider_append', true);

          $menu['Admin']->addChild('Gestion des pages', array('route' => 'CMS_pages'));

         





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

    private function comparePosition(PositionnableInterface $a, PositionnableInterface $b) {
        if ($a->getPosition() == $b->getPosition()) {
            return 0;
        }

        return ($a->getPosition() < $b->getPosition()) ? -1 : 1;
    }

}
