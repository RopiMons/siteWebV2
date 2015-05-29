<?php

namespace Ropi\IdentiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Ropi\IdentiteBundle\Form\ContactType;

class PersonneType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom')
                ->add('prenom')
                ->add('dateNaissance')
                ->add('contacts', 'collection', array(
                    'type' => new ContactType(),
                ))
                ->add('identifiantWeb', new \Ropi\AuthenticationBundle\Form\IdentifiantWebType())
                
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
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\IdentiteBundle\Entity\Personne',
             'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'ropi_identitebundle_personne';
    }

}
