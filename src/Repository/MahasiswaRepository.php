<?php

namespace App\Repository;

use App\Entity\Mahasiswa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

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

    public function countByKecamatan()
    {
        return $this->createQueryBuilder('m')
            ->select("k.nama as kecamatan, count(k.nama) as total")
            ->leftJoin("App\Entity\Kecamatan", "k")
            ->groupBy("m.lokasi")
            ->getQuery()
            ->execute()
        ;
    }
    

    
    public function findOneByNimWithJoin($value)
    {
        return $this->createQueryBuilder('m')
            ->select("m.nim, m.nama, m.kontak, m.email, w.kecamatan, w.kabupaten, w.provinsi")
            ->join("App\Entity\Wilayah", "w", Join::WITH, "m.kecamatan = w.id")
            ->where('m.nim = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function update(Mahasiswa $mahasiswa) 
    {
        return $this->createQueryBuilder('m')
            ->update()
            ->set("m.nama", "?1")
            ->set("m.email", "?2")
            ->set("m.kontak", "?3")
            ->set("m.kecamatan", "?4")
            ->setParameter(1, $mahasiswa->getNama())
            ->setParameter(2, $mahasiswa->getEmail())
            ->setParameter(3, $mahasiswa->getKontak())
            ->setParameter(4, $mahasiswa->getKecamatan()->getId())
            ->where('m.id = ?5')
            ->setParameter(5, $mahasiswa->getId())
            ->getQuery()
            ->execute()
        ;
    }

    public function countByNim($nim) 
    {
        // select "2020", count(*) as total from mahasiswa where nim like '%$nim%'
        return $this->createQueryBuilder("m")
            ->select("'" .$nim. "' as tahun, count(m)  as total")
            ->where("m.nim LIKE :nim")
            ->setParameter("nim", '%'.addcslashes($nim, '%_').'%')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
}
