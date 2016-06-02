<?php

namespace Ropi\IdentiteBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use  Ropi\AuthenticationBundle\Form\IdentifiantWebAdminType;


class PersonneAdminType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom')
                ->add('prenom',null,array(
                    'label' => 'Prénom'
                ))
                ->add('dateNaissance',BirthdayType::class,array(
                    'label' => 'Date de naissance'
                ))

                ->add('volonteMembre',null,array('required' => false,
                    'label' => ""
                ))
                ->add('contacts', CollectionType::class, array('required' => false,
                    'entry_type' => ContactType::class
                ))
        ->add('adresses', CollectionType::class, array('required' => false,
            'entry_type' => AdresseType::class
        ))
                ->add('identifiantWeb', IdentifiantWebAdminType::class, array( 'required' => false) )
               // ->add('identifiantWeb', new \Ropi\AuthenticationBundle\Form\IdentifiantWebType())
                
        //->add('creeLe')
        /* ->add('contacts', 'collection', array(
          'type' => new ContactType(),
          'allow_add' => true,
          )) */
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\IdentiteBundle\Entity\Personne',
             'cascade_validation' => true,
            'validation_groups' => array("admin")
        ));
    }

}
