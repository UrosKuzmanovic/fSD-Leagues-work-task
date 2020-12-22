<?php

namespace App\Repository;

use App\Entity\Klub;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Klub|null find($id, $lockMode = null, $lockVersion = null)
 * @method Klub|null findOneBy(array $criteria, array $orderBy = null)
 * @method Klub[]    findAll()
 * @method Klub[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KlubRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Klub::class);
    }

    // /**
    //  * @return Klub[] Returns an array of Klub objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Klub
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
