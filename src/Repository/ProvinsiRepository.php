<?php

namespace App\Repository;

use App\Entity\Provinsi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Provinsi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Provinsi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Provinsi[]    findAll()
 * @method Provinsi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProvinsiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Provinsi::class);
    }

    // /**
    //  * @return Provinsi[] Returns an array of Provinsi objects
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
    public function findOneBySomeField($value): ?Provinsi
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
