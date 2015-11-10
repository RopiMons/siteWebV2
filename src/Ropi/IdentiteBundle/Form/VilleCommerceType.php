<?php

namespace Ropi\IdentiteBundle\Form;

use Ropi\IdentiteBundle\Form\EventListener\CodePostalSubscriber;
use Symfony\Component\Form\FormBuilderInterface;

class VilleCommerceType extends VilleType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->addEventSubscriber(new CodePostalSubscriber());

    }
}
