<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;
class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::insert([
            // 'mapel_id' => 1,
            'romawi'=> 'I',
            'code_kelas'=> 'A',
        ]);
    }
}
