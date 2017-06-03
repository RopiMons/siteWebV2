<?php

namespace Ropi\CommerceBundle\Datatables;

use Ropi\CommerceBundle\Entity\Commerce;
use Ropi\IdentiteBundle\Entity\Adresse;
use Ropi\IdentiteBundle\Entity\AdresseRepository;
use Ropi\IdentiteBundle\Entity\Ville;
use Sg\DatatablesBundle\Datatable\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Style;
use Sg\DatatablesBundle\Datatable\Column\Column;
use Sg\DatatablesBundle\Datatable\Column\BooleanColumn;
use Sg\DatatablesBundle\Datatable\Column\ActionColumn;
use Sg\DatatablesBundle\Datatable\Column\MultiselectColumn;
use Sg\DatatablesBundle\Datatable\Column\VirtualColumn;
use Sg\DatatablesBundle\Datatable\Column\DateTimeColumn;
use Sg\DatatablesBundle\Datatable\Column\ImageColumn;
use Sg\DatatablesBundle\Datatable\Filter\TextFilter;
use Sg\DatatablesBundle\Datatable\Filter\NumberFilter;
use Sg\DatatablesBundle\Datatable\Filter\SelectFilter;
use Sg\DatatablesBundle\Datatable\Filter\DateRangeFilter;
use Sg\DatatablesBundle\Datatable\Editable\CombodateEditable;
use Sg\DatatablesBundle\Datatable\Editable\SelectEditable;
use Sg\DatatablesBundle\Datatable\Editable\TextareaEditable;
use Sg\DatatablesBundle\Datatable\Editable\TextEditable;


/**
 * Class CommerceDatatable
 *
 * @package Ropi\CommerceBundle\Datatables
 */
class CommerceDatatable extends AbstractDatatable
{

    /**
     * @return \Closure
     */
    public function getLineFormatter()
    {
        $formatter = function($row){

            foreach ($row['adresses'] as $i => $adresseUnique){
                /** @var Adresse $adresse */
                $adresse = $this->em->getRepository(Adresse::class)->adresseCommerce($adresseUnique['id']);
                $row['adresse'] = $adresse->getRue() . ", " . $adresse->getNumero() . "<br>" . $adresse->getVille()->getCodePostal() . " " . $adresse->getVille()->getVille();
            }

            $row['nom'] = "<a href='".$this->router->generate('commerce_view',array('nom'=>$row['nom']))."'>".$row['nom']."</a>";
            return $row;
        };



        return $formatter;

    }

    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {

        $this->language->set(array(
            'cdn_language_by_locale' => true
        ));

        $this->ajax->set(array(
        ));

        $this->options->set(array(
            'individual_filtering' => true,
            'individual_filtering_position' => 'head',
            'order_cells_top' => true,
            'classes' => Style::BOOTSTRAP_4_STYLE,
            'order' => array(array(0, 'asc')),
            'search_in_non_visible_columns' => true,
        ));

        $this->features->set(array(
        ));

        dump($this->em->getRepository(Commerce::class)->getCodePostalWithCommerceValideAndVisible());

        $filtreOptions = array();
        foreach ($this->em->getRepository(Commerce::class)->getCodePostalWithCommerceValideAndVisible() as $tab){
            $filtreOptions[$tab['codePostal']] = $tab['codePostal'] . " " . $tab['ville'];
        }

        $this->columnBuilder
            ->add('logo', ImageColumn::class, array(
                'title' => 'Logo',
                'imagine_filter' => 'thumbnail_50_x_50',
                'imagine_filter_enlarged' => 'thumbnail_250_x_250',
                'enlarge' => true,
                'relative_path' => 'images/logos',
                'searchable' => false,
                'orderable' => false,
                'responsive_priority' => 0
            ))
            ->add('adresses.rue',Column::class, array(
                'data' => 'adresses[, ].rue',
                'visible' => false
            ))
            ->add('adresses.ville.codePostal',Column::class, array(
                'data' => 'adresses[, ].ville.codePostal',
                'visible' => false
            ))
            ->add('adresses.ville.ville',Column::class, array(
                'data' => 'adresses[, ].ville.ville',
                'visible' => false
            ))
            ->add('nom', NomColumn::class, array(
                'title' => 'Nom',
                'responsive_priority' => 0
                ))

            ->add('adresse', VirtualColumn::class, array(
                'title' => 'Adresse',
                'searchable' => true,
                'search_column' => 'adresses_ville.codePostal',
                'filter' => array(SelectFilter::class, array(
                    'search_type' => 'eq',
                    'multiple' => true,
                    'select_options' => array('' => 'Tous') + $filtreOptions,
                    'cancel_button' => true,
                )),
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'Ropi\CommerceBundle\Entity\Commerce';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'commerce_datatable';
    }
}
