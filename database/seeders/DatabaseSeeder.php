<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,

            // WilayahSeeder::class,
            // ProvinsiSeeder::class,
            // KabupatenSeeder::class,
            // KecamatanSeeder::class,

            WilayahSeeder::class,
            Provinsi2Seeder::class,
            Kabupaten2Seeder::class,
            Kecamatan2Seeder::class,
            Desa2Seeder::class,
        ]);
    }
}
