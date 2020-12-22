<?php

namespace App\Controller\Admin;

use App\Entity\Kabupaten;
use App\Service\ProvinsiService;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class KabupatenCrudController extends AbstractCrudController
{
    private $provinsiService;

    public function __construct(ProvinsiService $provinsiService)
    {
        $this->provinsiService = $provinsiService;
    }

    public static function getEntityFqcn(): string
    {
        return Kabupaten::class;
    }

    
    public function configureFields(string $pageName): iterable
    {   
        $fields = [
            TextField::new('nama', 'Kabupaten')
        ];

        switch ($pageName) {
            case Crud::PAGE_INDEX:
                $fields[] = TextField::new('provinsi', 'Provinsi')->setSortable(true);
                break;

            case Crud::PAGE_NEW:
            case Crud::PAGE_EDIT:
                $provinsi = $this->provinsiService->getAllProvinsi();
                foreach ($provinsi as $p) {
                    $provChoices[$p->getNama()] = $p; 
                }

                $fields[] = ChoiceField::new('provinsi', "Provinsi")
                                ->setChoices($provChoices)
                                ->setRequired(true);

                break;

        }

        return $fields;
    }
    
}
