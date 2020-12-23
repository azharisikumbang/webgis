<?php

namespace App\Controller\Api;

use App\Entity\Kecamatan;
use App\Entity\Mahasiswa;
use App\Http\ApiOkResponse;
use App\Service\WilayahService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChartController extends AbstractController
{
    /**
     * @Route("/api/chart", name="api_chart")
     */
    public function index(): Response
    {
    	$start = 2002;
    	$now = date("Y");

    	$yearCounter = [];

    	for ($start; $start <= $now; $start++) { 
    		$yearCounter[] = $this->getDoctrine()
								->getRepository(Mahasiswa::class)
								->countByNim($start);
    	}

        return $this->json(
    		new ApiOkResponse(
    			Response::HTTP_OK,
    			Response::$statusTexts[Response::HTTP_OK],
    			$yearCounter
    		)
    	);
    }

    /**
     * @Route("/api/chart/{year}", name="api_chart_by_year")
     */
    public function getChartByYear($year): Response
    {
        return $this->json(
            new ApiOkResponse(
                Response::HTTP_OK,
                Response::$statusTexts[Response::HTTP_OK],
                $this->getDoctrine()
                    ->getRepository(Kecamatan::class)
                    ->countMahasiswaByYear($year)
            )
        );
    }

    /**
     * @Route("/api/chart/{kecamatan}/year", name="api_chart_by_kecamatan")
     */
    public function getChartByKecamatan(WilayahService $wilayahService, $kecamatan): Response
    {

        $start = 2002;
        $now = date("Y");

        $yearCounter = [];

        for ($start; $start <= $now; $start++) { 
            $yearCounter[$start] = $wilayahService->countMahasiswaByKecamatanAndYear($kecamatan, $start);
        }

        return $this->json(
            new ApiOkResponse(
                Response::HTTP_OK,
                Response::$statusTexts[Response::HTTP_OK],
                $yearCounter
            )
        );
    }


}
