<?php

namespace App\Controller\Admin;

use App\Entity\Mahasiswa;
use App\Entity\User;
use App\Entity\Wilayah;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Webgis');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Mahasiswa', 'fas fa-list', Mahasiswa::class);
        yield MenuItem::linkToCrud('Data Kecamatan', 'fas fa-map-marked', Wilayah::class);
        yield MenuItem::linkToCrud('Pengguna', 'fas fa-users', User::class);
    }
}
