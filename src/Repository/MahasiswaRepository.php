<?php

namespace App\Repository;

use App\Entity\Mahasiswa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mahasiswa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mahasiswa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mahasiswa[]    findAll()
 * @method Mahasiswa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MahasiswaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mahasiswa::class);
    }

    // /**
    //  * @return Mahasiswa[] Returns an array of Mahasiswa objects
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
    public function findOneBySomeField($value): ?Mahasiswa
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
