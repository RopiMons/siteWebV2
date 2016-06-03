<?php

namespace Ropi\CommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ropi\IdentiteBundle\Form\AdresseCommerceType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CommerceAdminType extends CommerceType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        parent::buildForm($builder,$options);

        $builder
            ->add('visible', null, array(
                'label' => 'Publier les informations sur le site ',
                'required' => false,
                'data' => true
            ))
            ->add('depot', null, array(
                'label' => 'Est-ce qu\'il est possible de se faire livrer des Ropi dans ce commerce ?'
            ))
            ->remove("imageFile")
            ->add('imageFile', VichImageType::class, array(
                'required' => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true

            ))

            ->add('personnes',null,array(
                'label' => 'Personne(s) physique(s) associée(s) à ce commerce ',
                'expanded' => false,
                'multiple' => true
            ))

            //->add('createdAt')
            //->add('updateAt')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\CommerceBundle\Entity\Commerce'
        ));
    }
    
}
