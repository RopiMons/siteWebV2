<?php

namespace Ropi\CommerceBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\DBAL\Types\Type;
use Ropi\IdentiteBundle\Entity\Personne;

/**
 * CommerceRep ository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommerceRepository extends EntityRepository {

    public function getCountNoValidatesCommercant() {
        return $this->createQueryBuilder("com")
                        ->select(array('COUNT(com.nom)'))
                        ->where('com.valide = :false')
                        ->setParameter('false', FALSE, Type::BOOLEAN)
                        ->getQuery()
                        ->getSingleScalarResult()
        ;
    }

    public function getMyCommerces(Personne $personne){
        return $this->createQueryBuilder("c")
            ->select(array('c','p'))
            ->join("c.personnes","p")
            ->where("p.id = :id")
            ->setParameter('id',$personne->getId())
            ->getQuery()
            ->execute()
            ;
    }

    public function getValideCommerces(){
        return $this->createQueryBuilder("c")
            ->select(array('c'))
            ->where("c.valide = :true")
            ->setParameter("true",true)
            ->getQuery()
            ->execute()
            ;
    }

    public function getPublicCommerces(){
        return $this->createQueryBuilder("c")
            ->select(array('c','cot','p','a','v'))
            ->leftJoin("c.cotisations","cot")
            ->leftJoin("cot.paiements","p")
            ->leftJoin("c.adresses","a")
            ->leftJoin("a.ville","v")
            ->where("c.valide = :true")
            ->andWhere("c.visible = :true")
            ->setParameter("true",true)
            ->getQuery()
            ->execute()
            ;
    }


    public function getCodePostalWithCommerceValideAndVisible(){

        $qb = $this->createQueryBuilder('c');

        return $qb
            ->select('DISTINCT(v.codePostal) AS codePostal, v.ville')
            ->leftJoin('c.adresses','a')
            ->leftJoin('a.ville','v')
            ->where('c.visible = :true')
            ->andWhere('c.valide = :true')
            ->setParameter('true',true)
            ->getQuery()
            ->execute()
            ;
    }

    public function getForMap(){
        return $this->createQueryBuilder("c")
            ->select(array("c","a","v","cot","p"))
            ->leftJoin("c.adresses","a")
            ->leftJoin("a.ville","v")
            ->leftJoin("c.cotisations","cot")
            ->leftJoin("cot.paiements","p")
            ->where('c.visible = :true')
            ->andWhere('c.valide = :true')
            ->setParameter('true',true)
            ->getQuery()
            ->useQueryCache(true)
            ->useResultCache(true)
            ->execute()
            ;
    }

}
