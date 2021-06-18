<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('petugas')->insert([
            'user_id' => 2,
            'tgl_lahir' => '1990-05-11',
            'no_hp' => '082211445566',
            'alamat' => 'Jl. Ranggalawe no.13',
        ]);
    }
}  

