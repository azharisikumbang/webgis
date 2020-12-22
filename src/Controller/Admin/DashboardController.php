<?php

namespace App\Controller\Admin;

use App\Entity\Kabupaten;
use App\Entity\Kecamatan;
use App\Entity\Mahasiswa;
use App\Entity\Provinsi;
use App\Entity\User;
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
        return $this->render('admin/dashboard.html.twig', [
            'dashboard_controller_filepath' => (new \ReflectionClass(static::class))->getFileName(),
            'dashboard_controller_class' => (new \ReflectionClass(static::class))->getShortName(),
        ]);
        // return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Webgis')
        ;
    }

    public function configureMenuItems(): iterable
    {
         return [
            MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),
            MenuItem::linkToRoute('Lihat Peta', 'fa fa-map-marked', 'home'),
            MenuItem::linkToCrud('Mahasiswa', 'fas fa-list', Mahasiswa::class),
            MenuItem::subMenu('Wilayah', 'fa fa-marker')->setSubItems([
                MenuItem::linkToCrud('Provinsi', 'fa fa-tags', Provinsi::class),
                MenuItem::linkToCrud('Kabupaten', 'fa fa-file-text', Kabupaten::class),
                MenuItem::linkToCrud('Kecamatan', 'fa fa-comment', Kecamatan::class),
            ]),
            MenuItem::linkToCrud('Pengguna', 'fas fa-users', User::class),
            MenuItem::linkToLogout('Keluar', 'fa fa-sign-out')
        ];
    }
}
