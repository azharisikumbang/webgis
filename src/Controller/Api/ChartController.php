<?php

namespace App\Controller\Api;

use App\Entity\Kecamatan;
use App\Entity\Mahasiswa;
use App\Http\ApiOkResponse;
use App\Service\ChartService;
use App\Service\WilayahService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChartController extends AbstractController
{
    private $chartService;

    public function __construct(ChartService $chartService) 
    {
        $this->chartService = $chartService;
    }

    /**
     * @Route("/api/chart", name="api_chart", methods={"GET"})
     */
    public function index(): Response
    {
        // 2002 => tahun awal mahasiswa terdata
        $chartData = $this->chartService->chartByYearRange(2002, date("Y"));

        return $this->json(
    		new ApiOkResponse(
    			Response::HTTP_OK,
    			Response::$statusTexts[Response::HTTP_OK],
    			$chartData
    		)
    	);
    }

    /**
     * @Route("/api/chart/{year}", name="api_chart_by_year", methods={"GET"})
     */
    public function getChartByYear($year): Response
    {
        return $this->json(
            new ApiOkResponse(
                Response::HTTP_OK,
                Response::$statusTexts[Response::HTTP_OK],
                $this->chartService->chartByYear($year)
            )
        );
    }

    /**
     * @Route("/api/chart/{kecamatan}/year", name="api_chart_by_kecamatan", methods={"GET"})
     */
    public function getChartByKecamatan($kecamatan): Response
    {

        $chartData = $this->chartService->chartMahasiswaByKecamatanAndTahunNim((int) $kecamatan);

        return $this->json(
            new ApiOkResponse(
                Response::HTTP_OK,
                Response::$statusTexts[Response::HTTP_OK],
                $chartData
            )
        );
    }


}
