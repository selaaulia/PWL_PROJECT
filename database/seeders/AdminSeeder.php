<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'user_id' => 1,
            'no_hp' => '082156789054',
            'alamat' => 'Jl. Lidah Mertua no.24',
        ]);
    }
}
