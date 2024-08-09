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
            ['nama' => 'Admin', 'email' => 'admin@gmail.com', 'no_hp' => '0111111111', 'role_id' => 1, 'password' => Hash::make('password'), 'status_verifikasi' => 'terverifikasi'],
        ];

        DB::table('users')->insert($user);
    }
}
