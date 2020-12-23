<?php

namespace App\Repository;

use App\Entity\Kecamatan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Kecamatan|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kecamatan|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kecamatan[]    findAll()
 * @method Kecamatan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KecamatanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kecamatan::class);
    }

    public function countMahasiswa()
    {
        // select k.nama as kecamatan, count(*) as total from kecamatan k left join mahasiswa m on m.lokasi_id = k.id group by k.id;
        return $this->createQueryBuilder("k")
            ->select("k.nama as kecamatan, COUNT(k.nama) as total")
            ->join("App\Entity\Mahasiswa", "m",  Join::WITH, "k.id = m.lokasi")
            ->groupBy("k.id")
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Kecamatan[] Returns an array of Kecamatan objects
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
    public function findOneBySomeField($value): ?Kecamatan
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
