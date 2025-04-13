<?php

namespace App\Entity;

use App\Repository\MahasiswaRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $kontak;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Kecamatan::class, inversedBy="mahasiswas")
     */
    private $lokasi;

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

    public function setKontak(?string $kontak): self
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

    public function getLokasi(): ?Kecamatan
    {
        return $this->lokasi;
    }

    public function setLokasi(?Kecamatan $lokasi): self
    {
        $this->lokasi = $lokasi;

        return $this;
    }

    public function getProvinsi()
    {
        return $this->lokasi->getProvinsi();
    }

    public function getKabupaten()
    {
        return $this->lokasi->getKabupaten();
    }
}
