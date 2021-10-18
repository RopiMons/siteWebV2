<?php

namespace Ropi\IdentiteBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

/**
 * PersonneRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PersonneRepository extends EntityRepository
{
    public function loadById($id){
        $q = $this
            ->createQueryBuilder('p')
            ->select(array('p','i','r','pe'))
            ->leftJoin('p.identifiantWeb','i')
             ->leftJoin('i.roles','r')
            ->leftJoin('i.permission','pe')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery();



        try {
            // La méthode Query::getSingleResult() lance une exception
            // s'il n'y a pas d'entrée correspondante aux critères
            $user = $q->getSingleResult();
        } catch (NoResultException $e) {
            throw new UsernameNotFoundException(sprintf('L\'utilisateur "%s" n\'a pas été trouvé ou n\'est pas actif.'), 0, $e);
        }

        return $user;

    }

}
