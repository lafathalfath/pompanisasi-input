<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            
            ['id' => 1, 'nama' => 'admin'],
            ['id' => 6, 'nama' => 'nasional'],
            ['id' => 2, 'nama' => 'wilayah'],
            ['id' => 3, 'nama' => 'provinsi'],
            ['id' => 4, 'nama' => 'kabupaten'],
            ['id' => 5, 'nama' => 'kecamatan'],
            
        ];

        DB::table('role')->insert($role);
    }
}
