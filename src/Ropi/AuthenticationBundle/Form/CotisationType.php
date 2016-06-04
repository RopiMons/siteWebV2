<?php

namespace Ropi\AuthenticationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CotisationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('montant',null,array(
                'label' => 'Montant définis pour la cotisation',
                'required' => true
            ))
            //->add('dateCreation', DateTimeType::class)
            /*->add('college',null,array(
                'label' => 'Collège a assigner',
                'required' => true
            ))*/
            //->add('personne')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\AuthenticationBundle\Entity\Cotisation'
        ));
    }
}
