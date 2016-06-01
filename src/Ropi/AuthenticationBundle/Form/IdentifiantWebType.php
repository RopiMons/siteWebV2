<?php

namespace Ropi\AuthenticationBundle\Form;

use Ropi\IdentiteBundle\Form\PersonneType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdentifiantWebType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',null,array(
                'label'=>'Nom d\'utilisateur'
            ))
            ->add('motDePasse',RepeatedType::class,array(
            'type' => PasswordType::class,
            'first_options' => array('label' => 'Mot de passe'),
            'second_options' => array('label' => 'Confirmation du mot de passe'),
            'invalid_message' => 'Les mots de passes ne sont pas identiques'))
            //->add('salt')
            //->add('lastConnection')
            //->add('createAt')
            ->add('Personne', PersonneType::class)
            ->add('actif',null,array("label"=>"Utilisateur Actif ?"))
            ->add('role')
            ->add('permission')
            //->add("submit","submit")
            
              
        ;
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
