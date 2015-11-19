<?php

namespace Ropi\CMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageDynamiqueType extends PageType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);


        $builder
            ->add('route',null,array(
                'label' => 'Nom de la route vers cette page'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\CMSBundle\Entity\PageDynamique'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ropi_cmsbundle_pagedynamique';
    }
}
