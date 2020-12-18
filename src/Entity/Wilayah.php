<?php

namespace App\Entity;

use App\Repository\WilayahRepository;
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
    private $nama;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $provinsi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nama_object;

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

    public function getProvinsi(): ?string
    {
        return $this->provinsi;
    }

    public function setProvinsi(string $provinsi): self
    {
        $this->provinsi = $provinsi;

        return $this;
    }

    public function getNamaObject(): ?string
    {
        return $this->nama_object;
    }

    public function setNamaObject(string $nama_object): self
    {
        $this->nama_object = $nama_object;

        return $this;
    }
}
