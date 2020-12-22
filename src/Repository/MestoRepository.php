<?php

namespace App\Repository;

use App\Entity\Mesto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mesto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mesto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mesto[]    findAll()
 * @method Mesto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MestoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mesto::class);
    }

    // /**
    //  * @return Mesto[] Returns an array of Mesto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mesto
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
