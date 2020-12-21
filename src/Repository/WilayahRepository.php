<?php

namespace App\Repository;

use App\Entity\Wilayah;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method Wilayah|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wilayah|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wilayah[]    findAll()
 * @method Wilayah[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WilayahRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wilayah::class);
    }

    public function findWilayahWithMahasiswaCount()
    {
        // select wilayah.kecamatan, count(wilayah.kecamatan) as total from wilayah join mahasiswa on wilayah.id = mahasiswa.kecamatan_id group by wilayah.id
        return $this->createQueryBuilder("w")
            ->select("w.kecamatan, COUNT(w.kecamatan) as total")
            ->join("App\Entity\Mahasiswa", "m",  Join::WITH, "w.id = m.kecamatan")
            ->groupBy("w.id")
            ->getQuery()
            ->getResult();
    }

    // select m.nim, m.nama from wilayah w left join mahasiswa m on m.kecamatan_id = w.id where w.kecamatan = "KURANJI";
    public function findWithMahasiswa($key, $value) 
    {
        return $this->createQueryBuilder("w")
            ->select("m.nim, m.nama")
            ->join("App\Entity\Mahasiswa", "m", Join::WITH, "w.id = m.kecamatan")
            ->where("w." . $key . " = '" . $value . "'")
            ->getQuery()
            ->getResult();
    }

    public function fetchAllProvinces()
    {
        return $this->createQueryBuilder("w")
            ->select("w.provinsi")
            ->groupBy("w.provinsi")
            ->getQuery()
            ->getResult()
        ;
    }

    public function fetchAllKabupaten(string $provinsi = null)
    {
        $qb = $this->createQueryBuilder("w")
            ->select("w.kabupaten")
            ->groupBy("w.kabupaten");

        if ($provinsi !== null) {
            $qb->where("w.provinsi = '" . $provinsi . "'");
        }

        return $qb->getQuery()->getResult();
    }

    public function fetchAllKecamatan(string $kabupaten = null)
    {
        $qb = $this->createQueryBuilder("w")
            ->select("w.kecamatan")
            ->groupBy("w.kecamatan");

        if ($kabupaten !== null) {
            $qb->where("w.kabupaten = '" . $kabupaten . "'");
        }

        return $qb->getQuery()->getResult();
    }
}
