<?php

namespace Ropi\CommandeBundle\Form;

use Ropi\CommandeBundle\Entity\Paiement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class PaiementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('montant')
            ->add('date',DateType::class,array(
                'label' => 'Date de réception du paiement'
            ))
            ->add('referenceComptable')
            //->add('commande')
            ->add('moyenDePaiement',null,array(
                'required' => true,
                'choice_label' => "nom"
            ))
            ->addEventListener(FormEvents::PRE_SET_DATA,array(
                $this, 'onPreSetData'
            ))
        ;

    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\CommandeBundle\Entity\Paiement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ropi_commandebundle_paiement';
    }

    public function onPreSetData(FormEvent $event)
    {
       if($event->getData() === null){
           $paiement = new Paiement();
           $paiement->setDate(new \DateTime());
           $event->setData($paiement);
       }
    }


}
