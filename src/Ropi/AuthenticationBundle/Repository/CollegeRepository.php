<?php

namespace Ropi\AuthenticationBundle\Repository;

/**
 * CollegeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CollegeRepository extends \Doctrine\ORM\EntityRepository
{
    public function getQBofCollege1et2(){
        return $this->createQueryBuilder("c")
            ->select(array('c'))
            ->where('c.numero = :un')
            ->orWhere('c.numero = :deux')
            ->setParameter('un',1)
            ->setParameter('deux',2)
            ;
    }
}
