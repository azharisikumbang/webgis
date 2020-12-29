<?php

namespace App\Controller\Admin;

use App\Entity\GeoJson;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GeoJsonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GeoJson::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('location', "File GeoJson"),
            ImageField::new('file', "File GeoJson")->setUploadDir('/public/geojson/'),
            BooleanField::new('status', "Aktifkan"),
        ];
    }

}
