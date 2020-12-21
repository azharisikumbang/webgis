<?php

namespace App\Service;

use App\Exception\ApiBadRequestException;
use App\Model\WilayahByKecamatanRequest;
use App\Repository\WilayahRepository;
use App\Util\ErrorParser;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class WilayahService 
{
	private $wilayahRepository;

	private $validator;

	public function __construct(
			WilayahRepository $wilayahRepository,
			ValidatorInterface $validator
		) 
	{
		$this->wilayahRepository = $wilayahRepository;
		$this->validator = $validator;
	}

	public function getTotalMahasiswaPerKecamatan()
	{
		return $this->wilayahRepository->findWilayahWithMahasiswaCount();
	}

	public function getMahasiswaPerKecamatan(string $kecamatan) 
	{
		$wilayahByKecamatanRequest = $this->createWilayahByKecamatanReqeust($kecamatan);

		$errors = $this->validator->validate($wilayahByKecamatanRequest);

		if (count($errors) > 0) {
			$err = ErrorParser::parse($errors);

			throw new ApiBadRequestException($err);
			
		}

		return $this->wilayahRepository->findWithMahasiswa("kecamatan", $wilayahByKecamatanRequest->kecamatan); 
	}

	public function getProvinces()
	{
		return $this->wilayahRepository->fetchAllProvinces();
	}

	public function getKabupaten(string $provinsi = null)
	{
		return $this->wilayahRepository->fetchAllKabupaten($provinsi);
	}

	public function getKecamatan(string $kabupaten = null)
	{
		return $this->wilayahRepository->fetchAllKecamatan($kabupaten);
	}

	public function getByKecamatan(string $kecamatan) 
	{
		return $this->wilayahRepository->findOneBy(["kecamatan" => $kecamatan]);
	}

	public function findBy($criteria) 
	{
		if (!is_array($criteria)) {
			$criteria = ["id" => $criteria];
		}

		return $this->wilayahRepository->findBy($criteria);
	}


	private function createWilayahByKecamatanReqeust(string $kecamatan) : WilayahByKecamatanRequest
	{
		return new WilayahByKecamatanRequest($kecamatan);
	}

}