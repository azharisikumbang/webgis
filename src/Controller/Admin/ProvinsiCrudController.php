<?php

namespace App\Controller\Admin;

use App\Entity\Provinsi;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProvinsiCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Provinsi::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nama', "Provinsi"),
        ];
    }
    
}
