<?php

namespace App\Imports;

use App\Models\{User,Siswa};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DateTime;

class SiswaImport implements ToCollection, WithHEadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
           $user = User::updateOrCreate(
                [
                'name'      => $row['name'],
                'email'     => $row['email'],
                ],
                [
                'password'  => bcrypt($row['password']),
                'role_id'  => 3,
                ]
            );

            $siswa = Siswa::updateOrCreate(
                [
                'NIS'           => $row['nis'],
                ],
                [
                'tempat_lahir'  => $row['tempat_lahir'],
                'tanggal_lahir' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir']),
                'jenis_kelamin' => $row['jenis_kelamin'],
                'alamat'        => $row['alamat'],
                'user_id'       => $user->id,
                ]
            );
        }
    }

    public function startRow() : int
    {
        return 2;
    }
}
