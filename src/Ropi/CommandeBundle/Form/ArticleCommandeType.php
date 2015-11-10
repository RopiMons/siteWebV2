<?php

namespace Ropi\CommandeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleCommandeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite')
            ->add('article','text',array(
                'data_class' => "Ropi\CommandeBundle\Entity\Article",
                'disabled' => true,
            ))
            //->add('commande')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\CommandeBundle\Entity\ArticleCommande',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ropi_commandebundle_articlecommande';
    }
}
