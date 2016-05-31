<?php

namespace Ropi\CMSBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ropi\CMSBundle\Form\PageType;

class PageStatiqueForm extends PageType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        
        $builder
                ->add('contenu', TextareaType::class, array(
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
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\CMSBundle\Entity\PageStatique'
        ));
    }
    

}
