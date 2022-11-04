<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Guru;
use Carbon\Carbon;
class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Guru::insert([
            [
                'nip' => '123456789012345678',
                'user_id'=> 2,
                'mapels_id' => 1,
                'tempat_lahir' => 'Sumenep',
                'tanggal_lahir' => '2001-07-17',
                'alamat' => 'JL.Guntur',
                'jenis_kelamin' => 'laki-laki',
                'no_telp' => '08785922130199',
                'image' => 'storage/image/hero.jpg',
            ],
        ]);
    }
}
