<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 9/11/15
 * Time: 15:48
 */

namespace Ropi\IdentiteBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CodePostalSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(FormEvents::POST_SUBMIT => 'postSubmit');
    }

    public function postSubmit(FormEvent $event)
    {
        $cp = $event->getData()->getCodePostal();
        $form = $event->getForm();

        if(!preg_match("/70\d\d|73\d\d/",$cp)){
            $form->get('codePostal')->addError(new FormError("Il est nécessaire de se trouver dans la zone de Mons pour s'inscrire comme commerçant"));
        }

    }
}