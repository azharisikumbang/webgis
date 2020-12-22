<?php

namespace App\Service;

use App\Entity\Provinsi;
use App\Repository\ProvinsiRepository;

class ProvinsiService 
{

	private $provinsiRepository;

	public function __construct(ProvinsiRepository $provinsiRepository) 
	{
		$this->provinsiRepository = $provinsiRepository;
	}

	public function getAllProvinsi()
	{
		return $this->provinsiRepository->findAll();
	}

}