<?php

namespace App\Repository;

use App\Entity\Nastup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Nastup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nastup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nastup[]    findAll()
 * @method Nastup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NastupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nastup::class);
    }

    // /**
    //  * @return Nastup[] Returns an array of Nastup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nastup
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
