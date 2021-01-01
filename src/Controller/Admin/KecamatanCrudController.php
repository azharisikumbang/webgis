<?php

namespace App\Controller\Admin;

use App\Entity\Kecamatan;
use App\Service\KabupatenService;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class KecamatanCrudController extends AbstractCrudController
{
    private $kabupatenService;

    public function __construct(KabupatenService $kabupatenService)
    {
        $this->kabupatenService = $kabupatenService;
    }

    public static function getEntityFqcn(): string
    {
        return Kecamatan::class;
    }

    public function configureFields(string $pageName): iterable
    {   
        $fields = [
            TextField::new('nama', 'Kecamatan')
        ];

        switch ($pageName) {
            case Crud::PAGE_INDEX:
                $fields[] = TextField::new('kabupaten', 'Kabupaten')->setSortable(true);
                $fields[] = TextField::new('kabupaten.provinsi', 'Provinsi')->setSortable(true);
                break;

            case Crud::PAGE_NEW:
            case Crud::PAGE_EDIT:
                $provinsi = $this->kabupatenService->getAllKabupaten();
                foreach ($provinsi as $p) {
                    $provChoices[$p->getNama()] = $p; 
                }

                $fields[] = ChoiceField::new('kabupaten', "Kabupaten")
                                ->setChoices($provChoices)
                                ->setRequired(true);

                break;

        }

        return $fields;
    }
}
