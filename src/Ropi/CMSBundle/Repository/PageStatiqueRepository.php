<?php

namespace Ropi\CMSBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * PageStatiqueRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PageStatiqueRepository extends EntityRepository {

    public function getPageForCMS($categorieNom, $pageTitreMenu) {
        return $this->createQueryBuilder("p")
            ->select(array("p", "c", "perm"))
            ->join("p.categorie", "c")
            ->join("p.permissions",'perm')
            ->where("p.isActive = :true")
            ->andWhere("p.publicationDate <= :dateNow ")
            ->andWhere('p.titreMenu = :titreMenu')
            ->andWhere('c.nom = :nom')
            ->setParameter("true", true, \Doctrine\DBAL\Types\Type::BOOLEAN)
            ->setParameter('titreMenu', $pageTitreMenu)
            ->setParameter('nom', $categorieNom)
            ->setParameter('dateNow', new \DateTime(), \Doctrine\DBAL\Types\Type::DATETIME)
            ->getQuery()
            ->getSingleResult()
            ;
    }

}
