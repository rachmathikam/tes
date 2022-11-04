<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NilaiHarian;
class NilaiHarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NilaiHarian::insert(
            [[
            'mapels_id' => 1,
            'siswa_id' => 1,
            'KKM' => '60',
            'nilai_harian' => '60',
            'nilai_uts' => '60',
            'nilai_uas' => '60',

        ],
        [
            'mapels_id' => 2,
            'siswa_id' => 1,
            'KKM' => '60',
            'nilai_harian' => '60',
            'nilai_uts' => '60',
            'nilai_uas' => '60',
        ]]);
    }
}
