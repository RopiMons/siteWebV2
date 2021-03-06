<?php

namespace Ropi\IdentiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ropi\IdentiteBundle\Form\ContactType;

class PersonneModifAdminType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username',null,array("label"=>"nom d'utilisateur"))

            ->add('actif',null,array("label"=>"Utilisateur Actif ?"))
            ->add('role')
            ->add('permission')
            ->add('Personne', Personne2Type::class)

                
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
            'data_class' => 'Ropi\AuthenticationBundle\Entity\IdentifiantWeb',
             'cascade_validation' => true
        ));
    }

}
