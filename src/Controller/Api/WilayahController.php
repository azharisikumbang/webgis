<?php

namespace App\Controller\Api;

use App\Http\ApiOkResponse;
use App\Service\WilayahService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WilayahController extends AbstractController
{
    /**
     * @Route("/api/wilayah", name="api_wilayah")
     */
    public function index(WilayahService $wilayahService): Response
    {
        return $this->json(
        	new ApiOkResponse(
    			Response::HTTP_OK,
    			Response::$statusTexts[Response::HTTP_OK],
    			$wilayahService->countMahasiswaPerKecamatan()
    		)

        );
    }

    /**
     * @Route("/api/wilayah/{kecamatan}/mahasiswa", name="api_wilayah_mahasiswa")
     */
    public function getMahasiswaByKecamatan(WilayahService $wilayahService, string $kecamatan): Response
    {
        return $this->json(
        	new ApiOkResponse(
    			Response::HTTP_OK,
    			Response::$statusTexts[Response::HTTP_OK],
    			$wilayahService->getMahasiswaByKecamatan(strtoupper($kecamatan))
    		)

        );
    }
}
