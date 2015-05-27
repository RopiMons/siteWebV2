<?php

namespace Ropi\IdentiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * 
     */
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('typeContact')
            ->add('valeur',null,array(
                'label' => ' ',
            ))
            //->add('personne')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\IdentiteBundle\Entity\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ropi_identitebundle_contact';
    }
}
