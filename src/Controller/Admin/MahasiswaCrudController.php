<?php

namespace App\Controller\Admin;

use App\Admin\Field\MahasiswaField;
use App\Entity\Mahasiswa;
use App\Service\MahasiswaService;
use App\Service\WilayahService;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Provider\AdminContextProvider;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MahasiswaCrudController extends AbstractCrudController
{
    private $mahasiswaService;

    private $wilayahService;

    public function __construct(MahasiswaService $mahasiswaService, WilayahService $wilayahService) 
    {
        $this->mahasiswaService = $mahasiswaService;
        $this->wilayahService = $wilayahService;
    }

    public static function getEntityFqcn(): string
    {
        return Mahasiswa::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('nim'),
            TextField::new('nama'),
            TextField::new('kontak'),
            TextField::new('email')
        ];

        switch ($pageName) {
            case Crud::PAGE_INDEX:
                $fields[] = MahasiswaField::new('lokasi', 'Tempat Tinggal')->setSortable(true);
                break;

            case Crud::PAGE_NEW:
            case Crud::PAGE_EDIT:
                $kecamatan = $this->wilayahService->getAllKecamatan();

                foreach ($kecamatan as $k) {
                    $kecChoices[$k->getNama()] = $k; 
                }

                $fields[] = ChoiceField::new('lokasi', "Kecamatan")
                                ->setChoices($kecChoices)
                                ->setRequired(true)
                            ;

                break;

             case Crud::PAGE_DETAIL:
                $fields[] = TextField::new('lokasi', "Kecamatan");
                $fields[] = TextField::new('lokasi.kabupaten', "Kabupaten");
                $fields[] = TextField::new('lokasi.kabupaten.provinsi', "Provinsi");
                break;

        }

        return $fields;
    }

    // admin.js untuk handling input form
    // public function configureAssets(Assets $assets) : Assets
    // {
    //     return $assets->addJsFile("js/admin.js");
    // }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
        ;
    }

}
