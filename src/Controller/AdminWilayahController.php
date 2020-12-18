<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminWilayahController extends AbstractController
{
    /**
     * @Route("/admin/wilayah", name="admin_wilayah")
     */
    public function index(): Response
    {
        return $this->render('admin_wilayah/index.html.twig', [
            'controller_name' => 'AdminWilayahController',
        ]);
    }
}
