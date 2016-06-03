<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 1/06/16
 * Time: 13:40
 */

namespace Ropi\ParametresBundle\Service;


use Doctrine\ORM\EntityManager;
use Ropi\ParametresBundle\Entity\Parametre;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;

class Parametres
{
    /**
     * @var EntityManager
     */
    private $entityManager;


    public function  __construct(EntityManager $entityManager){

        $this->entityManager = $entityManager;

    }

    public function getValueOf($string){

        $parametre = $this->entityManager->getRepository(Parametre::class)->findOneBy(array('nom'=>$string));

        if($parametre) {
            return $parametre->getValeur();
        }else{
            throw new ParameterNotFoundException("Ce paramètres $string n'a pas été trouvé");
        }

    }



}