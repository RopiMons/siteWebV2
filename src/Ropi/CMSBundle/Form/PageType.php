<?php

namespace Ropi\CMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $dt = new \DateTime();
        $years = range($dt->format('Y'),$dt->format('Y')+4);

        $builder
                //->add('position')
                ->add('categorie', null, array(
                    'label' => 'Catégorie de la page',
                    'property' => 'nom',
                    'required' => true
                ))
                ->add('titreMenu', null, array(
                    'label' => 'Titre à afficher dans le menu',
                ))
                ->add('isActive', 'checkbox', array(
                    'label' => 'Est-ce que cette page peut-être publiée ?',
                    'data' => true,
                    'required' => false,
                ))
                //->add('lastUpdate')
                //->add('createdAt')
                ->add('publicationDate', 'datetime', array(
                    'label' => 'Postposer la publication de cette page à ',
                    'format' => 'dd/MM/y HH:mm',
                    'years' => $years,
                ))
            ->add('permissions',null,array(
                'expanded' => true,
                'label' => 'Qui peux voir cette page ?'
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\CMSBundle\Entity\Page'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ropi_cmsbundle_page';
    }
}
