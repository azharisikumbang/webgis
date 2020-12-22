<?php

namespace App\Repository;

use App\Entity\Kabupaten;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Kabupaten|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kabupaten|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kabupaten[]    findAll()
 * @method Kabupaten[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KabupatenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kabupaten::class);
    }

    // /**
    //  * @return Kabupaten[] Returns an array of Kabupaten objects
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
    public function findOneBySomeField($value): ?Kabupaten
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
