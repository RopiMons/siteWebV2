<?php

namespace Ropi\CommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EtiquetteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',null,array("label"=>"Nom","data"=>"titre"))
            ->add('description')
            ->add('logo')
            ->add('certification')
            ->add('Enregistrer','submit')    
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\CommerceBundle\Entity\Etiquette'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ropi_commercebundle_etiquette';
    }
}
