<?php

namespace Ropi\CMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Ropi\CMSBundle\Form\PageType;

class PageStatiqueType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('page', new PageType(), array(
                    'label' => 'Informations sur la page'
                ))
                ->add('titre', null, array(
                    'label' => 'Titre de la page'
                ))
                ->add('contenu', null, array(
                    'label' => 'Contenu de la page',
                ))

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ropi\CMSBundle\Entity\PageStatique'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'ropi_cmsbundle_pagestatique';
    }

}
