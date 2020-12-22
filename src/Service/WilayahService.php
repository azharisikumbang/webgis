<?php

namespace App\Service;

use App\Repository\ProvinsiRepository;
use App\Repository\KabupatenRepository;
use App\Repository\KecamatanRepository;

class WilayahService 
{

	private $provinsiRepository;
	private $kabupatenRepository;
	private $kecamatanRepository;

	public function __construct(
		ProvinsiRepository $provinsiRepository,
		KabupatenRepository $kabupatenRepository,
		KecamatanRepository $kecamatanRepository
	) 
	{
		$this->provinsiRepository = $provinsiRepository;
		$this->kabupatenRepository = $kabupatenRepository;
		$this->kecamatanRepository = $kecamatanRepository;
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

}