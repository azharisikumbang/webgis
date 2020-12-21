<?php

namespace App\Controller\Admin;

use App\Admin\Field\MahasiswaField;
use App\Entity\Mahasiswa;
use App\Entity\Wilayah;
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
            IdField::new('id')->hideOnForm()->hideOnIndex(),
            TextField::new('nim'),
            TextField::new('nama'),
            TextField::new('kontak'),
            TextField::new('email')
        ];

        switch ($pageName) {
            case Crud::PAGE_INDEX:
                $fields[] = MahasiswaField::new('kecamatan.kecamatan', 'Kecamatan')->setSortable(true);
                break;

            case Crud::PAGE_NEW:
                $provinsi = $this->wilayahService->getProvinces();

                foreach ($provinsi as $p) {
                    $provChoices[strtoupper($p["provinsi"])] = $p["provinsi"]; 
                }

                $fields[] = ChoiceField::new('kecamatan.provinsi', "Provinsi")
                                ->setChoices($provChoices)
                                ->setRequired(true);

                $fields[] = ChoiceField::new('kecamatan.kabupaten', "Kabupaten")
                                ->setChoices([""])
                                ->setRequired(true)
                                ->setFormTypeOption('disabled','disabled');

                $fields[] = ChoiceField::new('kecamatan.kecamatan', "Kecamatan")
                                ->setChoices([""])
                                ->setRequired(true)
                                ->setFormTypeOption('disabled','disabled');

                break;

            case Crud::PAGE_EDIT:
                $context = $this->get(AdminContextProvider::class)->getContext();

                $wilayahId = $context->getEntity()->getInstance()->getKecamatan()->getId(); 

                $kecamatanSelected = $this->wilayahService->findBy($wilayahId);

                $provinsi = $this->wilayahService->getProvinces();

                $kabupaten = $this->wilayahService->getKabupaten($kecamatanSelected[0]->getProvinsi());
                $kecamatan = $this->wilayahService->getKecamatan($kecamatanSelected[0]->getKabupaten());

                foreach ($provinsi as $p) {
                    $provChoices[strtoupper($p["provinsi"])] = $p["provinsi"]; 
                }

                foreach ($kabupaten as $kab) {
                    $kabupatenChoices[strtoupper($kab["kabupaten"])] = $kab["kabupaten"]; 
                }

                foreach ($kecamatan as $kec) {
                    $kecamatanChoices[strtoupper($kec["kecamatan"])] = $kec["kecamatan"]; 
                }

                $fields[] = ChoiceField::new('kecamatan.provinsi', "Provinsi")
                                ->setChoices($provChoices)
                                ->setRequired(true);

                $fields[] = ChoiceField::new('kecamatan.kabupaten', "Kabupaten")
                                ->setChoices($kabupatenChoices)
                                ->setRequired(true);

                $fields[] = ChoiceField::new('kecamatan.kecamatan', "Kecamatan")
                                ->setChoices($kecamatanChoices)
                                ->setRequired(true);

                break;

        }

        return $fields;
    }

    public function configureAssets(Assets $assets) : Assets
    {
        return $assets->addJsFile("js/admin.js");
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
        ;
    }

    public function configureResponseParameters(KeyValueStore $responseParameters): KeyValueStore
    {
        if (Crud::PAGE_DETAIL === $responseParameters->get('pageName')) {

            $fieldCollection = $responseParameters->get('entity')->getFields();

            $data = $this->mahasiswaService->single($fieldCollection["nim"]->getValue());

            $fields = [ 
                "kecamatan" => MahasiswaField::new("kecamatan", "Kecamatan")
                            ->textType($data['kecamatan'])
                            ->getAsDto(),
                "kabupaten" => MahasiswaField::new("kabupaten", "Kabupaten")
                            ->textType($data['kabupaten'])
                            ->getAsDto(),
                "provinsi" => MahasiswaField::new("provinsi", "Provinsi")
                            ->textType($data['provinsi'])
                            ->getAsDto()
            ];

            array_map(function ($field) use ($fieldCollection) {
                $fieldCollection->set($field);
            }, $fields);

        }

        return $responseParameters;
    }

    public function createEntity(string $entityFqcn)
    {
        $context = $this->get(AdminContextProvider::class)->getContext();

        if ($context->getCrud()->getCurrentPage() == Crud::PAGE_NEW && count($context->getRequest()->request)) {
            $mahasiswaRequest = $context->getRequest()->request->get("Mahasiswa");

            $mahasiswa = new Mahasiswa();
            $mahasiswa->setNim($mahasiswaRequest["nim"]);
            $mahasiswa->setNama($mahasiswaRequest["nama"]);
            $mahasiswa->setEmail($mahasiswaRequest["email"]);
            $mahasiswa->setKontak($mahasiswaRequest["kontak"]);

            $kecamatan = $this->wilayahService->getByKecamatan($mahasiswaRequest["kecamatan_kecamatan"]);

            $mahasiswa->setKecamatan($kecamatan);

            return $mahasiswa;
        }

        return new $entityFqcn();
    }
}
