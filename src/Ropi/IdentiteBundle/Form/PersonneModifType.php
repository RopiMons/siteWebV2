<?php

namespace Ropi\IdentiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ropi\IdentiteBundle\Form\Personne2Type;
use Ropi\IdentiteBundle\Form\ContactType;

class PersonneModifType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder

            ->add('Personne', Personne2Type::class)
            ;

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\AuthenticationBundle\Entity\IdentifiantWeb',
             'cascade_validation' => true
        ));
    }

}
