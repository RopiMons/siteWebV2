<?php

namespace Ropi\IdentiteBundle\Form;


use Ropi\IdentiteBundle\Entity\Personne;
use Symfony\Bridge\Doctrine\Tests\Fixtures\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonneType extends AbstractType {

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
                ->add('volonteMembre',null,array(
                    'label' => ""
                ))
                ->add('contacts', CollectionType::class, array(
                    'entry_type' => ContactType::class
                ))
        ->add('adresses', CollectionType::class, array(
            'entry_type' => AdresseType::class
        ))
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
            'data_class' => Personne::class,
             'cascade_validation' => true
        ));
    }

}
