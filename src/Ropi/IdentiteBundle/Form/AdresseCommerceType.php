<?php

namespace Ropi\IdentiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Ropi\IdentiteBundle\Form\VilleType;

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
                
            ->add('ville', new VilleType(), array(
                'cascade_validation' => true
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\IdentiteBundle\Entity\Adresse',
            'cascade_validation' =>true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ropi_identitebundle_adresse';
    }
}
