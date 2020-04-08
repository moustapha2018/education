<?php

namespace App\Repository;

use App\Entity\Rcategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Rcategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rcategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rcategorie[]    findAll()
 * @method Rcategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RcategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rcategorie::class);
    }

    // /**
    //  * @return Rcategorie[] Returns an array of Rcategorie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rcategorie
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
