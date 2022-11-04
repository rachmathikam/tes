<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mapel;
class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data = [
            'Bahasa Indonesia',
            'Bahasa Arab',
            'bahasa Inggris',
            'Matematika',
            ];

        foreach ($data as $datas){
            Mapel::create(['mata_pelajaran' => $datas]);
        }

    }
}
