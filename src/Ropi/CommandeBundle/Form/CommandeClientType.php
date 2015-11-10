<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 10/11/15
 * Time: 1:30
 */

namespace Ropi\CommandeBundle\Form;


use Symfony\Component\Form\FormBuilderInterface;

class CommandeClientType extends CommandeType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        parent::buildForm($builder,$options);

        $builder
            ->remove("statut")
            ->remove("client")
            ->add("articlesQuantite",'collection',array(
                'type' => new ArticleCommandeType(),
            ))
            ->add("modeDePaiement",null,array(
                'expanded' => true,
            ))
            ->add("modeDeLivraison",null,array(
                'expanded' => true,
            ))
            ->add("adresseDeLivraison",null,array(
                'expanded' => true,
            ))
        ;

    }
}