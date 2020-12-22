<?php

namespace App\Entity;

use App\Repository\KecamatanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KecamatanRepository::class)
 */
class Kecamatan
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
    private $nama;

    /**
     * @ORM\ManyToOne(targetEntity=Kabupaten::class, inversedBy="kecamatans", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $kabupaten;

    /**
     * @ORM\OneToMany(targetEntity=Mahasiswa::class, mappedBy="lokasi", cascade={"remove"})
     */
    private $mahasiswas;

    public function __construct()
    {
        $this->mahasiswas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getKabupaten(): ?Kabupaten
    {
        return $this->kabupaten;
    }

    public function setKabupaten(?Kabupaten $kabupaten): self
    {
        $this->kabupaten = $kabupaten;

        return $this;
    }

    /**
     * @return Collection|Mahasiswa[]
     */
    public function getMahasiswas(): Collection
    {
        return $this->mahasiswas;
    }

    public function addMahasiswa(Mahasiswa $mahasiswa): self
    {
        if (!$this->mahasiswas->contains($mahasiswa)) {
            $this->mahasiswas[] = $mahasiswa;
            $mahasiswa->setLokasi($this);
        }

        return $this;
    }

    public function removeMahasiswa(Mahasiswa $mahasiswa): self
    {
        if ($this->mahasiswas->removeElement($mahasiswa)) {
            // set the owning side to null (unless already changed)
            if ($mahasiswa->getLokasi() === $this) {
                $mahasiswa->setLokasi(null);
            }
        }

        return $this;
    }

    public function getProvinsi() {
        return $this->kabupaten->getProvinsi();
    }
    
    public function __toString() : string
    {
        return $this->getNama();
    }
}
