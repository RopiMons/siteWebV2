<?php

namespace IolaCorporation\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AlbumType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('uploadedFiles', FileType::class, array(
                'multiple' => true,
                'data_class' => null,
            ));


        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IolaCorporation\NewsBundle\Entity\Album'
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'iolacorporation_newsbundle_Album';
    }
}
