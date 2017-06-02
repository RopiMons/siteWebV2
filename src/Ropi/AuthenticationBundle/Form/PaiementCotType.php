<?php

namespace Ropi\AuthenticationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PaiementCotType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $thisYear = date("Y");
        $years = array($thisYear,$thisYear-1,$thisYear+1);
        $builder
            ->add('montant')

            ->add('numOperation',null,array(
                'label' => 'Numéro d\'opération'
            ))

            ->add('dateOperation', DateType::class,array(
                'label' => 'Date de l\'opération comptable',
                'years' => $years
            ))

            //->add('cotisation')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\AuthenticationBundle\Entity\PaiementCot'
        ));
    }
}
