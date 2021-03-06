<?php

namespace App\Repository;

use App\Entity\Astuce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Astuce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Astuce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Astuce[]    findAll()
 * @method Astuce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AstuceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Astuce::class);
    }

    // /**
    //  * @return Astuce[] Returns an array of Astuce objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Astuce
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
