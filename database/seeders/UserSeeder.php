<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['Admin', 'Izaq Aldi', 'Sela Aulia'];
        $email = ['admin@gmail.com', 'izaqaldi@gmail.com', 'selaaulia@email.com'];
        $password = ['12345678', '12345678', '12345678'];
        $username = ['admin', 'izaqaldi', 'selaaulia'];
        $role = ['admin', 'petugas', 'anggota'];

        for ($i = 0; $i < 3; $i++) {
            DB::table('users')->insert([
                'name' => $name[$i],
                'email' => $email[$i],
                'password' => Hash::make($password[$i]),
                'username' => $username[$i],
                'role' => $role[$i]
            ]);
        }
    }
}
