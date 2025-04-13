<?php

namespace App\DataFixtures;

use App\Entity\Kabupaten;
use App\Entity\Kecamatan;
use App\Entity\Mahasiswa;
use App\Entity\Provinsi;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DataAdministrasiDaerahFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = \Faker\Factory::create("id_ID");

        $data = $this->getAllData();

        foreach ($data as $provName => $kabs)
        {
            $provEntity = new Provinsi();
            $provEntity->setNama($provName);

            foreach ($kabs as $kabName => $kecs)
            {
                $kab = new Kabupaten();
                $kab->setNama($kabName);

                foreach ($kecs as $kecName)
                {
                    $kec = new Kecamatan();
                    $kec->setNama($kecName);
                    $manager->persist($kec);
                    $kab->addKecamatan($kec);

                    $randomMahasiswa = rand(1, 200);
                    for ($i = 0; $i < $randomMahasiswa; $i++)
                    {
                        $nim = rand(2002, 2025);
                        $mahasiswa = new Mahasiswa();
                        $mahasiswa->setNama($faker->name());
                        $mahasiswa->setNim($faker->numerify(sprintf("%s%s", $nim, "########")));
                        $mahasiswa->setEmail($faker->email());
                        $mahasiswa->setKontak($faker->phoneNumber());
                        $mahasiswa->setLokasi($kec);
                        $manager->persist($mahasiswa);
                    }
                }

                $manager->persist($kab);
                $provEntity->addKabupaten($kab);

                $manager->persist($provEntity);
                $manager->flush();
            }
        }
    }

    private function getAllData(): array
    {
        return [
            "KEPULAUAN_RIAU" => [
                "KOTA_TANJUNG_PINANG" => [
                    "TANJUNG_PINANG_TIMUR"
                ],
                "KARIMUN" => [
                    "KARIMUN"
                ],
                "KOTA_BATAM" => [
                    "BATUAMPAR"
                ]
            ],
            "SUMATERA_BARAT" => [
                "PASAMAN_BARAT" => [
                    "LUHAKNANDUO",
                    "SASAK_RANAH_PASISIE",
                    "SUNGAI_BEREMAS",
                    "PASAMAN",
                    "TALAMAU",
                    "GUNUNG_TULEH",
                    "KOTO_BALINGKA",
                    "LEMBAH_MELINTANG",
                    "KINALI"
                ],
                "DHARMASRAYA" => [
                    "SUNGAI_RUMBAI",
                    "KOTO_SALAK",
                    "PULAU_PUNJUNG"
                ],
                "AGAM" => [
                    "AMPEK_ANGKEK",
                    "AMPEK_KOTO",
                    "AMPEK_NAGARI",
                    "BANUHAMPU",
                    "KAMANG_MAGEK",
                    "LUBUK_BASUNG",
                    "MALALAK",
                    "MATUR",
                    "SUNGAI_PUA",
                    "TANJUNG_RAYA",
                    "MATUR"
                ],
                "PESISIR_SELATAN" => [
                    "BAYANG",
                    "EMPAT_JURAI",
                    "KOTO_SEBELAS_TARUSAN",
                    "LENGAYANG",
                    "PANCUNG_SOAL",
                    "RANAH_PESISIR",
                    "SUTERA"
                ],
                "SIJUNJUNG" => [
                    "KAMANG_BARU",
                    "KOTO_TUJUH",
                    "KUPITAN",
                    "SIJUNJUNG",
                    "SUMPUR_KUDUS"
                ],
                "SOLOK" => [
                    "DANAU_KEMBAR",
                    "GUNUNG_TALANG",
                    "HILIRAN_GUMANTI",
                    "KOTO_BARU",
                    "SEMBILAN_KOTO_SUNGAI_LASI"
                ],
                "SOLOK_SELATAN" => [
                    "KOTO_PARIK_GADANG_DI_ATEH",
                    "PAUH_DUO",
                    "SANGIR",
                    "SANGIR_BALAI_JINGGO",
                    "SUNGAI_PAGU"
                ],
                "TANAHDATAR" => [
                    "BATIPUH_SELATAN",
                    "LIMA_KAUM",
                    "LINTAU_BUO_UTARA",
                    "PADANG_GANTING",
                    "SUNGAYANG",
                    "TANJUNG_EMAS"
                ],
                "KEPULAUAN_MENTAWAI" => [
                    "SIPORA_SELATAN",
                    "SIPORA_UTARA"
                ],
                "KOTA_PADANG" => [
                    "PADANG_SELATAN",
                    "LUBUKBEGALUNG",
                    "PADANG_TIMUR",
                    "PADANG_BARAT",
                    "LUBUKKILANGAN",
                    "PADANG_UTARA",
                    "NANGGALO",
                    "KURANJI",
                    "PAUH",
                    "KOTO_TENGAH"
                ],
                "KOTA_BUKITTINGGI" => [
                    "MANDIANGIN_KOTO_SELAYAN"
                ],
                "KOTA_PAYAKUMBUH" => [
                    "PAYAKUMBUH_BARAT",
                    "PAYAKUMBUH_TIMUR"
                ],
                "KOTA_SAWAHLUNTO" => [
                    "BARANGIN",
                    "SILUNGKANG"
                ],
                "KOTA_PADANGPANJANG" => [
                    "PADANG_PANJANG_TIMUR",
                    "PADANG_PANJANG_BARAT"
                ],
                "KOTA_PARIAMAN" => [
                    "PARIAMAN_TENGAH",
                    "PARIAMAN_SELATAN"
                ],
                "LIMAPULUHKOTA" => [
                    "SITUJUAH_LIMO_NAGARI",
                    "GUGUAK",
                    "HARAU"
                ],
                "PADANGPARIAMAN" => [
                    "BATANG_ANAI",
                    "PARIAMAN_TENGAH",
                    "NAN_SABARIS",
                    "ENAM_LINGKUNG",
                    "PARIAMAN_UTARA",
                    "TUJUH_KOTO_SUNGAI_SARIK",
                    "PADANG_SAGO",
                    "DUA_KALI_SEBELAS_KAYU_TANAM",
                    "SUNGAI_LIMAU",
                    "PATAMUAN",
                    "LIMA_KOTO_TIMUR"
                ],
                "PASAMAN" => [
                    "DUAKOTO",
                    "RAO_SELATAN",
                    "RAO",
                    "MAPAT_TUNGGUL",
                    "RAO_UTARA",
                    "TIGO_NAGARI",
                    "BONJOL"
                ]
            ],
            "ACEH" => [
                "GAYOLUES" => [
                    "BLANGKEJEREN",
                    "DABUNGELANG"
                ],
                "ACEH_SINGKIL" => [
                    "SINGKIL"
                ]
            ],
            "SUMATERA_SELATAN" => [
                "MUARAENIM" => [
                    "LAWANG_KIDUL"
                ]
            ],
            "BENGKULU" => [
                "MUKO-MUKO" => [
                    "LIMA_KOTO",
                    "LUBUKPINANG"
                ],
                "REJANG_LEBONG" => [
                    "CURUP"
                ],
                "BENGKULU_UTARA" => [
                    "KERKAP"
                ],
                "BENGKULU" => [
                    "RATUAGUNG"
                ]
            ],
            "LAMPUNG" => [
                "PRINGSEWU" => [
                    "GADINGREJO"
                ]
            ],
            "SUMATERA_UTARA" => [
                "BATUBARA" => [
                    "TALAWI"
                ],
                "MANDAILINGNATAL" => [
                    "HUTA_BARGOT",
                    "NATAL",
                    "SIABU"
                ],
                "PADANGLAWAS" => [
                    "BARUMUN",
                    "SOSA"
                ],
                "PADANGSIDIMPUAN" => [
                    "PADANGSIDIMPUAN_TENGGARA"
                ],
                "TOBASAMOSIR" => [
                    "LUMBANJULU"
                ],
                "MEDAN" => [
                    "MEDAN_AMPLAS",
                    "MEDAN_KOTA",
                    "MEDAN_MAIMUN"
                ]
            ],
            "RIAU" => [
                "BENGKALIS" => [
                    "MANDAU"
                ],
                "INDRAGIRI_HULU" => [
                    "PERANAP"
                ],
                "KAMPAR" => [
                    "SALO",
                    "SIAK_HULU"
                ],
                "KUANTANSENGINGI" => [
                    "GUNUNGTOAR",
                    "KUANTANMUDIK",
                    "PUCUKRANTAU",
                    "SINGINGI"
                ],
                "PEKANBARU" => [
                    "BUKITRAYA",
                    "LIMAPULUH",
                    "MARPOYANDAMAI",
                    "PAYUNGSEKAKI",
                    "PEKANBARUKOTA",
                    "RUMBAI",
                    "RUMBAIPESISIR",
                    "SAIL",
                    "SENAPELAN",
                    "SUKAJADI",
                    "TAMPAN",
                    "TENAYANRAYA",
                    "BUKITRAYA",
                    "MARPOYANDAMAI",
                    "SAIL",
                    "TAMPAN",
                    "TENAYANRAYA"
                ],
                "ROKAN_HULU" => [
                    "UJUNGBATU"
                ],
                "SIAK" => [
                    "MEMPURA",
                    "SUNGAIAPIT",
                    "SUNGAIMANDAU",
                    "TUALANG",
                    "MINAS"
                ],
                "KOTA_DUMAI" => [
                    "DUMAI_BARAT"
                ]
            ],
            "JAMBI" => [
                "BUNGO" => [
                    "PASARMUARABUNGO",
                    "TANAHSEPENGGALLINTAS"
                ],
                "KERINCI" => [
                    "KAYUARO"
                ],
                "MERANGIN" => [
                    "BANGKO",
                    "BATANGMASUMAI",
                    "RENAHPAMENANG",
                    "TABIR",
                    "TABIR_BARAT",
                    "TABIR_SELATAN"
                ],
                "SAROLANGUN" => [
                    "SAROLANGUN"
                ],
                "TANJUNGJABUNG_TIMUR" => [
                    "MUARASABAK_BARAT",
                    "MUARASABAK_TIMUR"
                ],
                "TEBO" => [
                    "RIMBO_ILIR",
                    "RIMBOBUJANG"
                ],
                "KOTA_JAMBI" => [
                    "JALUTUNG",
                    "KOTABARU",
                    "PASAR_JAMBI",
                    "TELANAIPURA"
                ],
                "KOTA_SUNGAIPENUH" => [
                    "PESISIRBUKIT",
                    "SUNGAIPENUH"
                ]
            ],
            "JAWA_BARAT" => [
                "KOTA_BANDUNG" => [
                    "SUKAWARNA"
                ],
                "KOTA_BEKASI" => [
                    "DURENJAYA",
                    "KALIBARU"
                ]
            ],
            "BALI" => [
                "KOTA_DENPASAR" => [
                    "DENPASAR_TIMUR"
                ]
            ],
            "JAWA_TENGAH" => [
                "KLATEN" => [
                    "SERENGAN"
                ]
            ]
        ];


    }
}
