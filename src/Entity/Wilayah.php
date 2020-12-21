<?php

namespace App\Entity;

use App\Repository\WilayahRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WilayahRepository::class)
 */
class Wilayah
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kecamatan;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kabupaten;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $provinsi;

    /**
     * @ORM\OneToMany(targetEntity=Mahasiswa::class, mappedBy="kecamatan", cascade="all", orphanRemoval=true)
     */
    private $mahasiswa;

    public function __construct()
    {
        $this->mahasiswa = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKecamatan(): ?string
    {
        return $this->kecamatan;
    }

    public function setKecamatan(string $kecamatan): self
    {
        $this->kecamatan = $kecamatan;

        return $this;
    }

    public function getKabupaten(): ?string
    {
        return $this->kabupaten;
    }

    public function setKabupaten(string $kabupaten): self
    {
        $this->kabupaten = $kabupaten;

        return $this;
    }

    public function getProvinsi(): ?string
    {
        return $this->provinsi;
    }

    public function setProvinsi(string $provinsi): self
    {
        $this->provinsi = $provinsi;

        return $this;
    }

    /**
     * @return Collection|Mahasiswa[]
     */
    public function getMahasiswa(): Collection
    {
        return $this->mahasiswa;
    }

    public function addMahasiswa(Mahasiswa $mahasiswa): self
    {
        if (!$this->mahasiswa->contains($mahasiswa)) {
            $this->mahasiswa[] = $mahasiswa;
            $mahasiswa->setKecamatan($this);
        }

        return $this;
    }

    public function removeMahasiswa(Mahasiswa $mahasiswa): self
    {
        if ($this->mahasiswa->removeElement($mahasiswa)) {
            // set the owning side to null (unless already changed)
            if ($mahasiswa->getKecamatan() === $this) {
                $mahasiswa->setKecamatan(null);
            }
        }

        return $this;
    }
}
