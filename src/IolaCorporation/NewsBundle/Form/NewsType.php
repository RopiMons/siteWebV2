<?php

namespace IolaCorporation\NewsBundle\Form;

use IolaCorporation\NewsBundle\Entity\Album;
use IolaCorporation\NewsBundle\Form\AlbumType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('enable',null, array(
                'required' => false
            ))

            //->add('user')
            ->add('album',CollectionType::class, array(
                'entry_type' => AlbumType::class,
                'required' => false
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IolaCorporation\NewsBundle\Entity\News'
        ));
    }
}
