<?php

namespace Ropi\IdentiteBundle\Form;

use Ropi\IdentiteBundle\Entity\TypeAdresse;
use Ropi\IdentiteBundle\Entity\TypeAdresseRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ropi\IdentiteBundle\Form\VilleType;

class AdresseType extends AbstractType
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
                'label' => 'Numéro'
            ))
            ->add('complement',null,array(
                'label' => 'Complément d\'adresse',
                'required' => false
            ))
            ->add('typeAdresse',EntityType::class, array(
                'class' => TypeAdresse::class,
                'query_builder' => function(TypeAdresseRepository $er) {
                    return $er->createQueryBuilder('T')->where("T.obligatoire = 1");

                },
            )
            )
            ->add('ville', VilleType::class, array(
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
