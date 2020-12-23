<?php

namespace App\Controller\Api;

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
        	[
        		$wilayahService->countMahasiswaOnKecamatan()
        	]

        );
    }
}
