<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wilayah = [
            ['id' => 1, 'pj_id' => null, 'nama' => 'Wilayah I'],
            ['id' => 2, 'pj_id' => null, 'nama' => 'Wilayah II'],
            ['id' => 3, 'pj_id' => null, 'nama' => 'Wilayah III'],
            ['id' => 4, 'pj_id' => null, 'nama' => 'Wilayah IV'],
        ];

        DB::table('wilayah')->insert($wilayah);
    }
}
