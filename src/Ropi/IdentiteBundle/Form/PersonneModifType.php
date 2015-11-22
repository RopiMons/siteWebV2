<?php

namespace Ropi\IdentiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Ropi\IdentiteBundle\Form\ContactType;

class PersonneModifType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
           ->add('username',null,array("label"=>"nom d'utilisateur"))


            ->add('Personne', new \Ropi\IdentiteBundle\Form\PersonneType())



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
            'data_class' => 'Ropi\AuthenticationBundle\Entity\IdentifiantWeb',
             'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'ropi_identitebundle_personne_modif';
    }

}
