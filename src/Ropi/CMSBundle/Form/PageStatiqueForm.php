<?php

namespace Ropi\CMSBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Ropi\CMSBundle\Form\PageType;

class PageStatiqueForm extends PageType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        
        $builder
                ->add('contenu', 'textarea', array(
                    'label' => 'Contenu de la page',
                    'attr' => array(
                        'class'=>'tinymce',
                        'data-theme' => 'advanced'
                        )
                ))

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\CMSBundle\Entity\PageStatique'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'ropi_cmsbundle_pagestatique';
    }

}
