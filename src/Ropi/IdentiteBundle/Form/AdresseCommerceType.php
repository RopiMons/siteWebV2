<?php

namespace Ropi\IdentiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AdresseCommerceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rue',null,array(
                
            ))
            ->add('numero',null,array(
                
            ))
            ->add('complement',null,array(
                'label' => 'Complément d\'adresse',
                'required' => false
            ))
                
            ->add('ville', VilleCommerceType::class, array(
                'cascade_validation' => true
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\IdentiteBundle\Entity\Adresse',
            'cascade_validation' =>true
        ));
    }

}
