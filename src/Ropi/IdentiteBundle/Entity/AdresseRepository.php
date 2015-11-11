<?php

namespace Ropi\IdentiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AdresseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdresseRepository extends EntityRepository
{
    public function getAdresse($id, Personne $personne){

        return $this->createQueryBuilder('a')
            ->select(array('a'))
            ->join("a.personnes", 'p')
            ->where('a.id = :id')
            ->andWhere("p.id = :personneId")
            ->setParameter('id',$id)
            ->setParameter('personneId',$personne->getId())
            ->getQuery()
            ->getSingleResult()
            ;

    }
}
