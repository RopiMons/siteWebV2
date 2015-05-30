<?php

namespace Ropi\CommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Ropi\IdentiteBundle\Form\AdresseCommerceType;

class CommerceType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom', null, array(
                    'label' => 'Nom de votre commerce'
                ))
                ->add('description', null, array(
                    'label' => 'Description de votre commerce',
                    //'attr' => array(
                    //    'class' => 'tinymce',
                    //    'data-theme' => 'advanced'
                    //)
                ))
                ->add('adresses', 'collection', array(
                    'label' => 'Adresse de votre commerce',
                    'type' => new AdresseCommerceType(),
                    'cascade_validation' => true
                ))
                ->add('visible', null, array(
                    'label' => 'Publier les informations sur le site ',
                    'required' => false,
                    'data' => true
                ))

        //->add('createdAt')
        //->add('updateAt')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\CommerceBundle\Entity\Commerce'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'ropi_commercebundle_commerce';
    }

}
