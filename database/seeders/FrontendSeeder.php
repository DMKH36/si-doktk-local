<?php

namespace Database\Seeders;

use App\Models\Frontend;
use App\Models\FrontendContact;
use App\Models\FrontendPicture;
use App\Models\FrontendService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrontendSeeder extends Seeder
{
    public function run()
    {
        Frontend::create([
            'telephone' => '(024) 76480609',
            'email' => 'tekkom@undip.ac.id',
            'facebook' => 'https://www.facebook.com/dept.siskom.undip/',
            'twitter' => 'https://twitter.com/HimaskomUndip',
            'instagram' => 'https://www.instagram.com/tekom_undip/',
            'picture1' => 'fe-paragraf/p1.png',
            'title1' => 'Departemen Teknik Komputer',
            'subtitle1' => 'Fakultas Teknik - Universitas Diponegoro',
            'body1' => 'Program Studi Teknik Komputer berada di bawah Fakultas Teknik Undip. Teknik Komputer Undip ini memiliki perbedaan yang signifikan dengan Ilmu Komputer / Informatika yang ada di Fakultas Sains dan Matematika (dahulu MIPA). Teknik Komputer Undip menghasilkan lulusan yang ahli di bidang Embedded System, Security and Networking, Database Infrastructure dan mobile computing tergantung peminatan yang diambil.',
            'picture2' => 'fe-paragraf/p2.png',
            'title2' => 'Sistem Informasi Pengelolaan Dokumen Kemahasiswaan & Alumni',
            'subtitle2' => 'Departemen Teknik Komputer - Fakultas Teknik - Universitas Diponegoro',
            'body2' => 'Sistem Informasi Pengelolaan Dokumen Kemahasiswaan dan Alumni ini ditujukan kepada mahasiswa dan alumni Teknik Komputer. Sistem Informasi ini berisi dokumen dan surat yang dikeluarkan dan diterima oleh Departemen Teknik Komputer.',
            'wanumber' => '81391366399',
        ]);

        $picture = [
            [
                'picture' => 'hero-carousel/1.jpg'
            ],
            [
                'picture' => 'hero-carousel/2.jpg'
            ],
            [
                'picture' => 'hero-carousel/3.jpg'
            ],
            [
                'picture' => 'hero-carousel/4.jpg'
            ],
            [
                'picture' => 'hero-carousel/5.jpg'
            ],
            [
                'picture' => 'hero-carousel/6.jpg'
            ],
            [
                'picture' => 'hero-carousel/7.jpg'
            ],
        ];

        foreach($picture as $data => $pictures) {
            FrontendPicture::create($pictures);
        }

        $contact = [
            [
                'name' => 'Alamat',
                'text' => 'Jl. Prof. H. Soedarto, SH, Tembalang, Semarang, Indonesia 1269',
            ],
            [
                'name' => 'Email',
                'text' => 'tekkom@undip.ac.id',
            ],
            [
                'name' => 'No. Telepon',
                'text' => '(024) 76480609',
            ],
        ];
        
        foreach($contact as $key => $contacts) {
            FrontendContact::create($contacts);
        }

        $service = [
            [
                'text' => 'Pengelolaan Dokumen Kemahasiswaan & Alumni'
            ],
            [
                'text' => 'Ruang Tata Usaha Dept. Tekkom: Lt. 1 Gd. Departemen Teknik Komputer (Sebelah Dekanat Lama)'
            ],
        ];

        foreach($service as $value => $services) {
            FrontendService::create($services);
        }
    }
}
