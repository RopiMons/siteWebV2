<?php

/*
 * Copyright 2015 Version 1.0.0
 * Pour le Pass, projet gestion de log.
 * @author Huygens Adrien
 * contact adrien.huygens@gmail.com
 */

namespace Ropi\CMSBundle\Menu;

use Doctrine\ORM\EntityManager;
use Knp\Menu\FactoryInterface;
use Ropi\CMSBundle\Entity\PositionnableInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

Abstract class AbstractMenu  {

    use ContainerAwareTrait;

    /**
     * @param FactoryInterface $factory
     */
    /* public function __construct(FactoryInterface $factory)
      {
      $this->factory = $factory;
      } */
    protected $factory;
    protected $em;
    protected $permissions;

    public function __construct(FactoryInterface $factory, EntityManager $em, AuthorizationChecker $authorizationChecker, TokenStorage $tokenStorage) {
        $this->factory = $factory;
        $this->em = $em;
        if ($authorizationChecker->isGranted("IS_AUTHENTICATED_FULLY")) {
            $this->permissions = $tokenStorage->getToken()->getUser()->getRoles();
        } else {
            $this->permissions = array("ROLE_ANONYME");
        }
    }

    abstract protected function tableau();

    protected function gen($key, $valeur, $menu, $sous_menu = false, $compteur = 0) {
        if (!$sous_menu) {
            $menu->addChild($key, array('uri' => '#', 'label' => $key . ' ▼'))->setAttribute('class', 'dropdown');
            $menu[$key]->setLinkAttribute('class', 'dropdown-toggle');
            $menu[$key]->setLinkAttribute('role', 'buttons');
            $menu[$key]->setLinkAttribute('data-toggle', 'dropdown');
            $menu[$key]->setChildrenAttribute('role', 'menu');
            $menu[$key]->setChildrenAttribute('class', 'dropdown-menu');
        } else {
            if ($compteur <= 1)
                $menu->addChild($key, array('uri' => '#', 'label' => $key))->setAttribute('class', 'dropdown-submenu  ');
            else
                $menu->addChild($key, array('uri' => '#', 'label' => $key))->setAttribute('class', 'dropdown-submenu margin-left ');

            $menu[$key]->setLinkAttribute('class', 'dropdown-toggle');
            $menu[$key]->setLinkAttribute('role', 'button');
            $menu[$key]->setLinkAttribute('data-toggle', 'dropdown');
            $menu[$key]->setChildrenAttribute('role', 'sous-menu');
            $menu[$key]->setChildrenAttribute('class', 'dropdown-menu ');
        }
        foreach ($valeur as $keys => $value) {

            if (!is_array($value[key($value)])) {

                if (!$sous_menu) {
                    $menu[$key]->addChild($keys, $value)->setAttribute('divider_append', true);
                } else {
                    $menu[$key]->addChild($keys, $value)->setAttribute('divider_append', true)->setAttribute('class', " margin-left");
                }
            } else {

                $this->gen($keys, $value, $menu[$key], true, $compteur +=1);
            }
        }
    }

    public function createBreadcrumbMenu() {

        //$secu = $this->container->get('security.context');
        //dump($secu);
        $tab = $this->tableau();


        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', ' nav navbar-nav');

        $compteur = 0;
        foreach ($tab as $key => $value) {


            if (!is_array($value[key($value)])) {

                $menu->addChild($key, $value);
            } else {
                $this->gen($key, $value, $menu);
            }
        }







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
