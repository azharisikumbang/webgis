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
            ->select("m.id, w.kecamatan as nama_kecamatan, count(m.id) as total")
            ->leftJoin("App\Entity\Wilayah", "w")
            ->groupBy("m.kecamatan")
            ->getQuery();
    }
    

    
    public function findOneByNimWithJoin($nim)
    {
        // select m.nama, m.nim, m.kontak, m.email, k.nama as kecamatan, kab.nama as kabupaten, p.nama as provinsi from mahasiswa m join kecamatan k on k.id = m.lokasi_id join kabupaten kab on kab.id = k.kabupaten_id join provinsi p on p.id = kab.provinsi_id where m.nim = '$nim';
        return $this->createQueryBuilder('m')
            ->select("m.nim, m.nama, m.kontak, m.email, kec.nama as kecamatan, kab.nama as kabupaten, prov.nama as provinsi")
            ->join("App\Entity\Kecamatan", "kec", Join::WITH, "m.lokasi = kec.id")
            ->join("App\Entity\Kabupaten", "kab", Join::WITH, "kec.kabupaten = kab.id")
            ->join("App\Entity\Provinsi", "prov", Join::WITH, "kab.provinsi = prov.id")
            ->where('m.nim = ?1')
            ->setParameter(1, $nim)
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

    public function countByYear($year) 
    {
        
    }
    
}
