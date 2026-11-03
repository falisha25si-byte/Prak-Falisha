<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateFirstPelanggan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Pelanggan::create([
            'first_name' => 'Falisha',
            'last_name' => 'Apyuri',
            'birthday' => '2007/04/25',
            'gender' => 'Female',
            'email' => 'pelanggan@gmail.com',
            'phone' => '082169934565',
        ]);
    }
}
