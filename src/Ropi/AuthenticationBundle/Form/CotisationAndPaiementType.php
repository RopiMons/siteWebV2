<?php

namespace Ropi\AuthenticationBundle\Form;

use Ropi\AuthenticationBundle\Entity\PaiementCot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CotisationAndPaiementType extends AbstractType
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
            ->add('paiements',CollectionType::class,array(
                'entry_type' => PaiementCotType::class,
                'label' => 'Paiement effectué'
            ))
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
