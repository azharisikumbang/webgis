<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

    	return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/galeri", name="home_galeri")
     */
    public function galeriPage(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('home/galeri.html.twig');
    }

    /**
     * @Route("/visi-misi", name="home_visi_misi")
     */
    public function visiMisiPage(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('home/visi_misi.html.twig');
    }    


    /**
     * @Route("/tentang", name="home_tentang")
     */
    public function tentangPage(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('home/tentang.html.twig');
    }
    
  
}
