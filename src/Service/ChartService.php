<?php

namespace App\Service;

use App\Exception\ApiBadRequestException;
use App\Model\ChartByYearRequest;
use App\Repository\KecamatanRepository;
use App\Repository\MahasiswaRepository;
use App\Service\KecamatanService;
use App\Service\WilayahService;
use App\Util\ErrorParser;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ChartService 
{
	private MahasiswaRepository $mahasiswaRepository;
	private KecamatanRepository $kecamatanRepository;
	private WilayahService $wilayahService;
	private KecamatanService $kecamatanService;
	private ValidatorInterface $validator;

	public function __construct(
		MahasiswaRepository $mahasiswaRepository,
		KecamatanRepository $kecamatanRepository,
		WilayahService $wilayahService,
		KecamatanService $kecamatanService,
		ValidatorInterface $validator
	)
	{
		$this->mahasiswaRepository = $mahasiswaRepository;
		$this->kecamatanRepository = $kecamatanRepository;
		$this->wilayahService = $wilayahService;
		$this->kecamatanService = $kecamatanService;
		$this->validator = $validator;
	}

	public function chartByYearRange(string $start, string $end) : array
	{
		$arrayChartData = [];

    	for ($start; $start <= $end; $start++) { 
    		$arrayChartData[] = $this->mahasiswaRepository->countByNim($start);
    	}

		return $arrayChartData;
	}

	public function chartByYear($year)
	{
		$chartByYearRequest = $this->createChartByYearRequest($year);

		$errors = $this->validator->validate($chartByYearRequest);

		if (count($errors) > 0) {
			$errs = ErrorParser::parse($errors);

			throw new ApiBadRequestException($errs);
		}

		return $this->kecamatanRepository->countMahasiswaByYear($chartByYearRequest->year);
	}

	public function chartMahasiswaByKecamatanAndTahunNim($id){
		$kecamatanSingleRequest = $this->kecamatanService->createKecamatanSingleRequest($id);

		$errors = $this->validator->validate($kecamatanSingleRequest);

		if (count($errors) > 0) {
			$errs = ErrorParser::parse($errors);

			throw new ApiBadRequestException($errs);
		}

		$chartData = [];

		// 2002, tahun dimulai data 
		$start = 2002;
		$now = date("Y");
        for ($start; $start <= $now; $start++) { 
            $chartData[$start] = $this->wilayahService->countMahasiswaByKecamatanAndTahunNim($kecamatanSingleRequest->id, $start);
        }

        return $chartData;
	}

	private function createChartByYearRequest($year) : ChartByYearRequest
	{
		return new ChartByYearRequest($year);
	}

}