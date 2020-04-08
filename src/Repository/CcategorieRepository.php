<?php

namespace App\Repository;

use App\Entity\Ccategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ccategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ccategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ccategorie[]    findAll()
 * @method Ccategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CcategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ccategorie::class);
    }

    // /**
    //  * @return Ccategorie[] Returns an array of Ccategorie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ccategorie
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
