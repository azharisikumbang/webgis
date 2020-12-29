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

    public function getMahasiswa(string $kecamatan) 
    {
        // select m.nama, m.nim from kecamatan k left join mahasiswa m on k.id = m.lokasi_id where k.nama = '$kecamatan';
        return $this->createQueryBuilder("k")
            ->select("m.nama, m.nim")
            ->leftJoin("App\Entity\Mahasiswa", "m", Join::WITH, "k.id = m.lokasi")
            ->where("k.nama = ?1")
            ->setParameter(1, $kecamatan)
            ->getQuery()
            ->getResult()
        ;
    }

    public function countMahasiswaByYear($year, $limit = 10) 
    {
        // select k.nama as kecamatan, count(*) total from kecamatan k left join mahasiswa m on k.id = m.lokasi_id where m.nim like "2019%" group by k.nama order by total desc limit 10;
        return $this->createQueryBuilder("k")
            ->select("k.nama as kecamatan, count(k.nama) total")
            ->leftJoin("App\Entity\Mahasiswa", "m", Join::WITH, "k.id = m.lokasi")
            ->where("m.nim like ?1")
            ->setParameter(1, $year . "%")
            ->groupBy("k.nama")
            ->orderBy("total", "DESC")
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }

    public function countMahasiswaByKecamatanAndTahunNim($kecamatan, $year)
    {
        // select "2013" as tahun, count(*) as total from kecamatan k left join mahasiswa m on m.lokasi_id = k.id where m.nim like "2013%" AND k.id = $kecamatan
        return $this->createQueryBuilder("k")
            ->select("count(k.id) as total")
            ->leftJoin("App\Entity\Mahasiswa", "m", Join::WITH, "k.id = m.lokasi")
            ->where("m.nim like ?1")
            ->setParameter(1, $year . "%")
            ->AndWhere("k.id = ?2")
            ->setParameter(2, $kecamatan)
            ->getQuery()
            ->getOneOrNullResult()
        ;
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
