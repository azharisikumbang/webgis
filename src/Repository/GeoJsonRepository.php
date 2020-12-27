<?php

namespace App\Repository;

use App\Entity\GeoJson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GeoJson|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeoJson|null findOneBy(array $criteria, array $orderBy = null)
 * @method GeoJson[]    findAll()
 * @method GeoJson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeoJsonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeoJson::class);
    }

    // /**
    //  * @return GeoJson[] Returns an array of GeoJson objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GeoJson
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
