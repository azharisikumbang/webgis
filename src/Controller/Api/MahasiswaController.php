<?php

namespace App\Controller\Api;

use App\Http\ApiOkResponse;
use App\Service\MahasiswaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MahasiswaController extends AbstractController
{
    /**
     * @Route("/api/mahasiswa/{nim}", name="api_mahasiswa_single", methods={"GET"})
     */
    public function single(MahasiswaService $mahasiswaService, string $nim): Response
    {
    	return $this->json(
    		new ApiOkResponse(
    			Response::HTTP_OK,
    			Response::$statusTexts[Response::HTTP_OK],
    			$mahasiswaService->single($nim)
    		)
    	);
    }

}
