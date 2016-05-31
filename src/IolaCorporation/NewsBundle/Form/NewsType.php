<?php

namespace IolaCorporation\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use IolaCorporation\NewsBundle\Form\AlbumType;

class NewsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('news')
            //->add('dateEcriture')
            ->add('datePublication')
            ->add('enable',null, array('required' => false))

            //->add('user')
            ->add('album',"collection", array('type'=>new AlbumType(),'required' => false,"options" =>array("data_class" =>"IolaCorporation\NewsBundle\Entity\Album") ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IolaCorporation\NewsBundle\Entity\News'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'iolacorporation_newsbundle_news';
    }
}
