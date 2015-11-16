<?php

namespace Ropi\CommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Ropi\IdentiteBundle\Form\AdresseCommerceType;

class CommerceAdminType extends CommerceType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        parent::buildForm($builder,$options);

        $builder
            ->add('visible', null, array(
                'label' => 'Publier les informations sur le site ',
                'required' => false,
                'data' => true
            ))
            ->add('depot', null, array(
                'label' => 'Est-ce qu\'il est possible de se faire livrer des Ropi dans ce commerce ?'
            ))

            //->add('createdAt')
            //->add('updateAt')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\CommerceBundle\Entity\Commerce'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'ropi_commercebundle_commerce';
    }

}
