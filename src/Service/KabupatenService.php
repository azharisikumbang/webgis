<?php

namespace App\Service;

use App\Entity\Kabupaten;
use App\Repository\KabupatenRepository;

class KabupatenService 
{

	private $kabupatenRepository;

	public function __construct(KabupatenRepository $kabupatenRepository) 
	{
		$this->kabupatenRepository = $kabupatenRepository;
	}

	public function getAllKabupaten()
	{
		return $this->kabupatenRepository->findAll();
	}

}