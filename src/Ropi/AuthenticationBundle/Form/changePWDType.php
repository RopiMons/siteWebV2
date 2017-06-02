<?php

namespace Ropi\AuthenticationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ropi\AuthenticationBundle\Entity\Role;

class changePWDType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
     {

         $builder
             ->add('oldPassword',PasswordType::class,array('label'=>"Ancien mot de passe"))
             ->add('motDePasse', RepeatedType::class, array(
             'type' => PasswordType::class,
             'first_options' => array('label' => 'mot de passe:'),
             'second_options' => array('label' => 'Confirmation:'),
             'invalid_message' => 'les mots de pass ne sont pas les mêmes',
         ));
     }

     /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\AuthenticationBundle\Entity\IdentifiantWeb',
           
        ));
    }

}
