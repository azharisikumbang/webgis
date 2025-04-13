<?php

namespace App\Entity;

use App\Repository\KabupatenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KabupatenRepository::class)
 */
class Kabupaten
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
     * @ORM\OneToMany(targetEntity=Kecamatan::class, mappedBy="kabupaten", cascade={"remove"})
     */
    private $kecamatans;

    /**
     * @ORM\ManyToOne(targetEntity=Provinsi::class, inversedBy="kabupatens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $provinsi;

    public function __construct()
    {
        $this->kecamatans = new ArrayCollection();
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

    /**
     * @return Collection|Kecamatan[]
     */
    public function getKecamatans(): Collection
    {
        return $this->kecamatans;
    }

    public function addKecamatan(Kecamatan $kecamatan): self
    {
        if (!$this->kecamatans->contains($kecamatan))
        {
            $this->kecamatans[] = $kecamatan;
            $kecamatan->setKabupaten($this);
        }

        return $this;
    }

    public function removeKecamatan(Kecamatan $kecamatan): self
    {
        if ($this->kecamatans->removeElement($kecamatan))
        {
            // set the owning side to null (unless already changed)
            if ($kecamatan->getKabupaten() === $this)
            {
                $kecamatan->setKabupaten(null);
            }
        }

        return $this;
    }

    public function getProvinsi(): ?Provinsi
    {
        return $this->provinsi;
    }

    public function setProvinsi(?Provinsi $provinsi): self
    {
        $this->provinsi = $provinsi;

        return $this;
    }

    public function __toString(): string
    {
        return str_replace("_", " ", $this->getNama());
    }
}
