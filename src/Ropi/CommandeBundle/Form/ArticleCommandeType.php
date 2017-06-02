<?php

namespace Ropi\CommandeBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleCommandeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite',null,array(
                'attr' => array('min'=>'0')
            ))
            ->add('article',TextType::class,array(
                'data_class' => "Ropi\CommandeBundle\Entity\Article",
                'disabled' => true,
            ))
            //->add('commande')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\CommandeBundle\Entity\ArticleCommande',
        ));
    }
    
}
