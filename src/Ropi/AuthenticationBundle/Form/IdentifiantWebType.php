<?php

namespace Ropi\AuthenticationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Ropi\AuthenticationBundle\Entity\Role;

class IdentifiantWebType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',null,array("label"=>"nom d'utilisateur"))
            ->add('motDePasse','repeated',array(
            'type' => 'password',
            'first_options' => array('label' => 'mot de passe:'),
            'second_options' => array('label' => 'Confirmation:'),
            'invalid_message' => 'les mots de pass ne sont pas les mêmes'))
            //->add('salt')
            //->add('lastConnection')
            //->add('createAt')
            //->add('actif')
            ->add('roles',null,array())
            ->add('permission')
            ->add("submit","submit")
            
              
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\AuthenticationBundle\Entity\IdentifiantWeb',
           
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ropi_authenticationbundle_identifiantweb';
    }
}