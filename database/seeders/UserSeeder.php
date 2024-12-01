<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'nama' => 'Admin', 
                'email' => 'admin@gmail.com', 
                'no_hp' => '0111111111', 
                'role_id' => 1, 
                'password' => Hash::make('password'), 
                'status_verifikasi' => 'terverifikasi',
            ],
            [
                'nama' => 'PJ Kabupaten', 
                'email' => 'kabupaten@gmail.com', 
                'no_hp' => '001', 
                'role_id' => 4, 
                'password' => Hash::make('121212'), 
                'status_verifikasi' => 'terverifikasi',
            ],
            [
                'nama' => 'PJ Kecamatan', 
                'email' => 'kecamatan@gmail.com', 
                'no_hp' => '002', 
                'role_id' => 5, 
                'password' => Hash::make('121212'), 
                'status_verifikasi' => 'terverifikasi',
            ],
        ];

        DB::table('users')->insert($user);
    }
}
