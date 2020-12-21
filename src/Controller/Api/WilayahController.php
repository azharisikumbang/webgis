<?php

namespace App\Controller\Api;

use App\Entity\Mahasiswa;
use App\Entity\Wilayah;
use App\Http\ApiOkResponse;
use App\Service\WilayahService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WilayahController extends AbstractController
{
    /**
     * @Route("/api/wilayah", name="api_wilayah", methods={"GET"})
     */
    public function index(WilayahService $wilayahService): Response
    {
        return $this->json(
        	new ApiOkResponse(
        		Response::HTTP_OK,
        		Response::$statusTexts[Response::HTTP_OK],
        		$wilayahService->getTotalMahasiswaPerKecamatan()
        	)
        );
    }

    /**
     * @Route("/api/wilayah/{kecamatan}/mahasiswa", name="api_wilayah_with_mahasiswa", methods={"GET"})
     */
    public function mahasiswaPerKecamatan(WilayahService $wilayahService, string $kecamatan): Response
    {
        return $this->json(
            new ApiOkResponse(
                Response::HTTP_OK,
                Response::$statusTexts[Response::HTTP_OK],
                $wilayahService->getMahasiswaPerKecamatan($kecamatan)
            )
        );
    }

    /**
     * @Route("/api/wilayah/provinsi/{provinsi}", name="api_wilayah_provinsi", methods={"GET"})
     */
    public function getKabupatenByProvinsi(WilayahService $wilayahService, string $provinsi): Response
    {
        return $this->json(
            new ApiOkResponse(
                Response::HTTP_OK,
                Response::$statusTexts[Response::HTTP_OK],
                $wilayahService->getKabupaten($provinsi)
            )
        );
    }

    /**
     * @Route("/api/wilayah/kabupaten/{kabupaten}", name="api_wilayah_kabupaten", methods={"GET"})
     */
    public function getKecamatanByKabupaten(WilayahService $wilayahService, string $kabupaten): Response
    {
        return $this->json(
            new ApiOkResponse(
                Response::HTTP_OK,
                Response::$statusTexts[Response::HTTP_OK],
                $wilayahService->getKecamatan($kabupaten)
            )
        );
    }

}
