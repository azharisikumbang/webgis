<?php

namespace App\Service;

use App\Exception\ApiBadRequestException;
use App\Model\WilayahByKecamatanRequest;
use App\Repository\KabupatenRepository;
use App\Repository\KecamatanRepository;
use App\Repository\MahasiswaRepository;
use App\Repository\ProvinsiRepository;
use App\Util\ErrorParser;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class WilayahService 
{

	private $provinsiRepository;
	private $kabupatenRepository;
	private $kecamatanRepository;
	private $mahasiswaRepository;
	private $validator;

	public function __construct(
		ProvinsiRepository $provinsiRepository,
		KabupatenRepository $kabupatenRepository,
		KecamatanRepository $kecamatanRepository,
		MahasiswaRepository $mahasiswaRepository,
		ValidatorInterface $validator
	) 
	{
		$this->provinsiRepository = $provinsiRepository;
		$this->kabupatenRepository = $kabupatenRepository;
		$this->kecamatanRepository = $kecamatanRepository;
		$this->mahasiswaRepository = $mahasiswaRepository;
		$this->validator = $validator;
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

	public function countMahasiswaPerKecamatan() 
	{
		return $this->kecamatanRepository->countMahasiswa();
	}

	public function getMahasiswaByKecamatan(string $kecamatan) 
	{
		$kecamatanRequest = $this->createWilayahByKecamatanRequest($kecamatan);

		$error = $this->validator->validate($kecamatanRequest);

		if (count($error) > 0) {
			$errors = ErrorParser::parse($error);

			throw new ApiBadRequestException($errors);
		}

		return $this->kecamatanRepository->getMahasiswa($kecamatan);
	}

	public function countMahasiswaByKecamatanAndYear($kecamatan, $year) 
	{
		return $this->kecamatanRepository->countMahasiswaByKecamatanAndYear($kecamatan, $year);
	}

	public function countAll()
	{
		$result["kecamatan"] = $this->kecamatanRepository->count([]);
		$result["kabupaten"] = $this->kabupatenRepository->count([]);
		$result["provinsi"] = $this->provinsiRepository->count([]);
		$result["mahasiswa"] = $this->mahasiswaRepository->count([]);

		return $result;
	}

	private function createWilayahByKecamatanRequest($kecamatan) 
	{
		return new WilayahByKecamatanRequest($kecamatan);
	}

}