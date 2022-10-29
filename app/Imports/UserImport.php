<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'role'          => 'mahasiswa',
            'name'          => $row['nama'],
            'nim'           => $row['nim'],
            'email'         => $row['email'],
            'mobile_number' => $row['no_hp'],
            'gender'        => $row['jenis_kelamin'],
            'status'        => 1,
            'password'      => bcrypt('password'),
        ]);
    }
}
