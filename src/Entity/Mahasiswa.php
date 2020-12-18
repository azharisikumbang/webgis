<?php

namespace App\Entity;

use App\Repository\MahasiswaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MahasiswaRepository::class)
 */
class Mahasiswa
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $nim;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nama;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $kontak;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $kecamatan_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNim(): ?string
    {
        return $this->nim;
    }

    public function setNim(string $nim): self
    {
        $this->nim = $nim;

        return $this;
    }

    public function getNama(): ?string
    {
        return $this->nama;
    }

    public function setNama(string $nama): self
    {
        $this->nama = $nama;

        return $this;
    }

    public function getKontak(): ?string
    {
        return $this->kontak;
    }

    public function setKontak(string $kontak): self
    {
        $this->kontak = $kontak;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getKecamatanId(): ?int
    {
        return $this->kecamatan_id;
    }

    public function setKecamatanId(int $kecamatan_id): self
    {
        $this->kecamatan_id = $kecamatan_id;

        return $this;
    }
}
