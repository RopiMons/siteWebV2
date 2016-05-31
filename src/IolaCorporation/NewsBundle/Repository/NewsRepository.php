<?php

namespace IolaCorporation\NewsBundle\Repository;

use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Tools\Pagination\Paginator;
/**
 * NewsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NewsRepository extends \Doctrine\ORM\EntityRepository
{
    public function findNewNews($max = 1,$min =0)
{
    $x= $this->createQueryBuilder('d')
        ->addSelect('a')
        ->addSelect('f')
        ->addOrderBy('d.datePublication','DESC')
        ->addOrderBy('d.id','DESC')

        ->leftJoin('d.album', 'a')
        ->leftJoin("a.files","f")
        ->where('d.enable = True')
        ->andWhere('d.datePublication <= CURRENT_TIMESTAMP()');


    $x->setFirstResult($min);

    $x->setMaxResults($max);
    $pag = new Paginator($x);
    return $pag;

}
  public function findNewsGame()
{
    $x= $this->createQueryBuilder('d')
        
        ->addOrderBy('d.datePublication','DESC')
        ->addOrderBy('d.id','DESC')

        
        ->where('d.enabledGame = True')
        ->andWhere('d.datePublication <= CURRENT_TIMESTAMP()');


    ;
    return $x->getQuery()->execute();

}

    public function countNews(){

        $x= $this->createQueryBuilder('d')
            ->select('count(d)')
            ->addOrderBy('d.datePublication','DESC')
            ->addOrderBy('d.id','DESC')


            ->where('d.enable = True')
            ->andWhere('d.datePublication <= CURRENT_TIMESTAMP()');

        try{


        return $x->getQuery()->getSingleScalarResult();
        }
        catch (NoResultException $e){
            return 0;
        }

    }
    public function fiveNews($id){

    $x = $this->createQueryBuilder('n')
        ->addOrderBy('n.datePublication','DESC')
        ->where('n.id != :id')
        ->andWhere('n.enable =True')
        ->setParameter('id',$id)
        ->setMaxResults(5);
    return $x->getQuery()->execute();
}

    public function titreNews($start = 0, $stop = 50){

        $x = $this->createQueryBuilder('n')

            ->addOrderBy('n.datePublication','DESC')
            ->setFirstResult($start)
            ->setMaxResults($stop)
        ;

        return $x->getQuery()->execute();
    }
}
