<?php

namespace App\Repository;

use App\Entity\Igrac;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Igrac|null find($id, $lockMode = null, $lockVersion = null)
 * @method Igrac|null findOneBy(array $criteria, array $orderBy = null)
 * @method Igrac[]    findAll()
 * @method Igrac[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IgracRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Igrac::class);
    }

    // /**
    //  * @return Igrac[] Returns an array of Igrac objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Igrac
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
