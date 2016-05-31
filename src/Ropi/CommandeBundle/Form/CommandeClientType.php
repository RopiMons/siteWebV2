<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 10/11/15
 * Time: 1:30
 */

namespace Ropi\CommandeBundle\Form;


use Ropi\CommandeBundle\Entity\ModeDeLivraisonRepository;
use Ropi\CommandeBundle\Entity\ModeDePaiementRepository;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeClientType extends CommandeType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        parent::buildForm($builder,$options);

        $builder
            ->remove("statut")
            ->remove("client")
            ->add("articlesQuantite",CollectionType::class,array(
                'entry_type' => ArticleCommandeType::class,
            ))
            /*->add("modeDePaiement",null,array(
                'expanded' => true,
                'query_builder' => function(ModeDePaiementRepository $repository){
                    return $repository->createQueryBuilder('c')->where('c.actif = true');
                }
            ))*/

                /* ATTENTION !! Ces deux ci ne sont jamais utilisé */
            ->add("modeDeLivraison")
                ->add("adresseDeLivraison")
        ;

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'allow_extra_fields' => true,
            'data_class' => 'Ropi\CommandeBundle\Entity\Commande',
        ));
    }
}