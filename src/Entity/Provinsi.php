<?php

namespace App\Entity;

use App\Repository\ProvinsiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProvinsiRepository::class)
 */
class Provinsi
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
     * @ORM\OneToMany(targetEntity=Kabupaten::class, mappedBy="provinsi", cascade={"remove"})
     */
    private $kabupatens;

    public function __construct()
    {
        $this->kabupatens = new ArrayCollection();
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
     * @return Collection|Kabupaten[]
     */
    public function getKabupatens(): Collection
    {
        return $this->kabupatens;
    }

    public function addKabupaten(Kabupaten $kabupaten): self
    {
        if (!$this->kabupatens->contains($kabupaten)) {
            $this->kabupatens[] = $kabupaten;
            $kabupaten->setProvinsi($this);
        }

        return $this;
    }

    public function removeKabupaten(Kabupaten $kabupaten): self
    {
        if ($this->kabupatens->removeElement($kabupaten)) {
            // set the owning side to null (unless already changed)
            if ($kabupaten->getProvinsi() === $this) {
                $kabupaten->setProvinsi(null);
            }
        }

        return $this;
    }

    
    public function __toString() : string
    {
        return $this->getNama();
    }
}
