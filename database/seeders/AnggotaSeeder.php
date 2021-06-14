<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        DB::table('anggotas')->insert([
            'Nim' => 1941720196,
            'user_id' => 3,
            'Kelas' => 'TI 2C',
            'Jurusan' => 'Teknologi Informasi',
            'No_Hp' => '081111222333',
            'Gambar' => 'images/'.$faker->imageUrl(640, 480, 'gambar', true),
        ]);
    }
}

