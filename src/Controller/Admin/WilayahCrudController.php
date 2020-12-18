<?php

namespace App\Controller\Admin;

use App\Entity\Wilayah;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WilayahCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Wilayah::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
