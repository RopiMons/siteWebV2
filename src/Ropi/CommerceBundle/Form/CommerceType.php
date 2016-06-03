<?php

namespace Ropi\CommerceBundle\Form;

use Doctrine\ORM\EntityRepository;
use Ropi\AuthenticationBundle\Entity\College;
use Ropi\CommerceBundle\Entity\Commerce;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ropi\IdentiteBundle\Form\AdresseCommerceType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CommerceType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nom', null, array(
                'label' => 'Nom de votre commerce'
            ))
            ->add('college',EntityType::class,array(
                'label' => "Je souhaite inscrire mon commerce à ce collège",
                'class' => College::class,
                'query_builder' => function(EntityRepository $repository){
                    return $repository->getQBofCollege1et2();
                }
            ))
            ->add('description', null, array(
                'label' => 'Description de votre commerce',
                'attr' => array(
                    'class' => 'tinymce',
                    'data-theme' => 'advanced'
                )
            ))
            ->add('imageFile', VichImageType::class, array(
                'required' => true,
                'allow_delete'  => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true

            ))
            ->add('adresses', CollectionType::class, array(
                'label' => 'Adresse de votre commerce',
                'entry_type' => AdresseCommerceType::class
            ))
            /*->add('visible', null, array(
                'label' => 'Publier les informations sur le site ',
                'required' => false,
                'data' => true
            ))*/

            //->add('createdAt')
            //->add('updateAt')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\CommerceBundle\Entity\Commerce'
        ));
    }

}
