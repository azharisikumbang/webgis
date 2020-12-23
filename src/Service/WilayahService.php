<?php

namespace App\Service;

use App\Repository\KabupatenRepository;
use App\Repository\KecamatanRepository;
use App\Repository\MahasiswaRepository;
use App\Repository\ProvinsiRepository;

class WilayahService 
{

	private $provinsiRepository;
	private $kabupatenRepository;
	private $kecamatanRepository;
	private $mahasiswaRepository;

	public function __construct(
		ProvinsiRepository $provinsiRepository,
		KabupatenRepository $kabupatenRepository,
		KecamatanRepository $kecamatanRepository,
		MahasiswaRepository $mahasiswaRepository
	) 
	{
		$this->provinsiRepository = $provinsiRepository;
		$this->kabupatenRepository = $kabupatenRepository;
		$this->kecamatanRepository = $kecamatanRepository;
		$this->mahasiswaRepository = $mahasiswaRepository;
	}

	public function getAllProvinsi()
	{
		return $this->provinsiRepository->findAll();
	}

	public function getAllKabupaten()
	{
		return $this->kabupatenRepository->findAll();
	}

	public function getAllKecamatan()
	{
		return $this->kecamatanRepository->findAll();
	}

	public function countMahasiswaOnKecamatan() 
	{
		return $this->mahasiswaRepository->countByKecamatan();
	}

}