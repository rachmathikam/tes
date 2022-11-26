<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\user;
use App\Models\Guru;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            ['name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role_id' => 1],

            ['name' => 'Rachmat Hikam',
            'email' => 'hikam@gmail.com',
            'password' => bcrypt('hikam123'),
            'role_id' => 3],

            ['name' => 'Arya sultan',
            'email' => 'arya@gmail.com',
            'password' => bcrypt('arya123'),
            'role_id' => 3],
            ['name' => 'Aura Ayu',
            'email' => 'aura@gmail.com',
            'password' => bcrypt('aura123'),
            'role_id' => 3],
        ]);
    }
}
