<?php

namespace App\Service;

use App\Entity\Mahasiswa;
use App\Repository\MahasiswaRepository;

class MahasiswaService 
{

	private $mahasiswaRepository;

	public function __construct(MahasiswaRepository $mahasiswaRepository) 
	{
		$this->mahasiswaRepository = $mahasiswaRepository;
	}

	public function mahasiswaPerKecamatan()
	{
		return $this->mahasiswaRepository->countByKecamatan();
	}

	public function single(string $nim) 
	{
		return $this->mahasiswaRepository->findOneByNimWithJoin($nim);
	}

	public function update(Mahasiswa $mahasiswa) 
	{
		return $this->mahasiswaRepository->update($mahasiswa);
	}
}