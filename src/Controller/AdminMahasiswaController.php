<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMahasiswaController extends AbstractController
{
    /**
     * @Route("/admin/mahasiswa", name="admin_mahasiswa")
     */
    public function index(): Response
    {
        return $this->render('admin_mahasiswa/index.html.twig', [
            'controller_name' => 'AdminMahasiswaController',
        ]);
    }
}
