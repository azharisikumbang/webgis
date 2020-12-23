<?php

namespace App\Controller;

use App\Service\WilayahService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChartController extends AbstractController
{
    /**
     * @Route("/chart", name="chart")
     */
    public function index(WilayahService $wilayahService): Response
    {
    	$kecamatan = $wilayahService->getAllKecamatan();

        return $this->render('chart/index.html.twig', [
            'kecamatan' => $kecamatan,
        ]);
    }
}
