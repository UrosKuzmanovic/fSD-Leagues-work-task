<?php

namespace App\Repository;

use App\Entity\Pozicija;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pozicija|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pozicija|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pozicija[]    findAll()
 * @method Pozicija[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PozicijaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pozicija::class);
    }

    // /**
    //  * @return Pozicija[] Returns an array of Pozicija objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pozicija
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
