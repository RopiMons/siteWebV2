<?php

namespace Ropi\CMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ropi\CMSBundle\Form\PageType;

class PageStatiqueType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('page', PageType::class, array(
                    'label' => 'Informations sur la page'
                ))
                ->add('titre', null, array(
                    'label' => 'Titre de la page'
                ))
                ->add('contenu', null, array(
                    'label' => 'Contenu de la page',
                ))

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\CMSBundle\Entity\PageStatique'
        ));
    }

}
