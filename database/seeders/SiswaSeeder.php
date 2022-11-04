<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;
class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Siswa::insert([
            [
                'NIS' => '1234567890',
                'user_id'=> 3,
                'kelas_id' => 1,
                'tempat_lahir' => 'Sumenep',
                'tanggal_lahir' => '2001-07-17',
                'alamat' => 'JL.Guntur',
                'jenis_kelamin' => 'laki-laki',
                'image' => 'storage/image/hero.jpg',
            ],
        ]);
    }
}
