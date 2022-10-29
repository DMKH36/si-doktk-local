<?php

namespace Database\Seeders;

use App\Models\Receiver;
use App\Models\User;
use App\Models\Sender;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserSeeder extends Seeder
{
    public function run()
    {
        $user = [
            [
                'name'      => 'Admin',
                'email'     => 'admin@admin.com',
                'password'  => bcrypt('password'),
                'role'      => 'admin',
                'nim'       => '0',
                'gender'    => 'L',
                'status'    => '1',
            ],
            [
                'name'      => 'Dr. Adian Fatchur Rochim, S.T., M.T. SMIEEE',
                'email'     => 'kadep@kadep.com',
                'password'  => bcrypt('password'),
                'role'      => 'kadep',
                'nim'       => '197302261998021001',
                'gender'    => 'L',
                'status'    => '1',
            ],
            [
                'name'      => 'Adnan Fauzi S.T., M.Kom.',
                'email'     => 'koor@koor.com',
                'password'  => bcrypt('password'),
                'role'      => 'koor',
                'nim'       => 'H.7.198101272018071001',
                'gender'    => 'L',
                'status'    => '1',
            ],
            [
                'name'      => 'Muhammad Abdul Majid',
                'email'     => 'muhammadabdulmajid36@gmail.com',
                'password'  => bcrypt('password'),
                'role'      => 'admin',
                'nim'       => '21120118140042',
                'gender'    => 'L',
                'status'    => '1',
            ],
            [
                'name'      => 'Mahasiswa Aktif',
                'email'     => 'mahasiswa1@mahasiswa.com',
                'password'  => bcrypt('password'),
                'role'      => 'mahasiswa',
                'nim'       => '21120118',
                'gender'    => 'L',
                'status'    => '1',
            ],
            [
                'name'      => 'Mahasiswa Tidak Aktif',
                'email'     => 'mahasiswa2@mahasiswa.com',
                'password'  => bcrypt('password'),
                'role'      => 'mahasiswa',
                'nim'       => '21120119',
                'gender'    => 'P',
                'status'    => '0',
            ],
            [
                'name'      => 'Alumni Aktif',
                'email'     => 'alumni1@alumni.com',
                'password'  => bcrypt('password'),
                'role'      => 'alumni',
                'nim'       => '21120115',
                'gender'    => 'P',
                'status'    => '1',
            ],
            [
                'name'      => 'Alumni Tidak Aktif',
                'email'     => 'alumni2@alumni.com',
                'password'  => bcrypt('password'),
                'role'      => 'alumni',
                'nim'       => '21120114',
                'gender'    => 'L',
                'status'    => '0',
            ],
        ];

        foreach($user as $data => $value){
            User::create($value);
        }

        $sender = [
            [
                'user_id'   => 2,
                'name'      => 'Dr. Adian Fatchur Rochim, S.T., M.T. SMIEEE',
                'lembaga'   => 'Teknik Komputer',
                'address'   => 'Dept. Tekkom: Lt. 1 Gd. Departemen Teknik Komputer (Sebelah Dekanat Lama)',
                'email'     => 'kadep@kadep.com',
                'phone'     => ''
            ]
        ];

        foreach($sender as $data => $value){
            Sender::create($value);
        }

        $receiver = [
            [
                'user_id'   => 2,
                'name'      => 'Dr. Adian Fatchur Rochim, S.T., M.T. SMIEEE',
                'lembaga'   => 'Teknik Komputer',
                'address'   => 'Dept. Tekkom: Lt. 1 Gd. Departemen Teknik Komputer (Sebelah Dekanat Lama)',
                'email'     => 'kadep@kadep.com',
                'phone'     => '',
            ],
        ];

        foreach($receiver as $data => $value){
            Receiver::create($value);
        }
    }
}
