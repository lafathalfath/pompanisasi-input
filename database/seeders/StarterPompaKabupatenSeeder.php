<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StarterPompaKabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kabupaten = Kabupaten::all();
        $starter_data = [];
        foreach ($kabupaten as $kab) {
            $starter_data[] = [
                'kabupaten_id' => $kab->id,
                'total_unit' => 0,
            ];
        }

        DB::table('starter_ref_diterima_kabupaten')->insert($starter_data);
        DB::table('starter_ref_dimanfaatkan_kabupaten')->insert($starter_data);
        DB::table('starter_abt_usulan_kabupaten')->insert($starter_data);
        DB::table('starter_abt_diterima_kabupaten')->insert($starter_data);
        DB::table('starter_abt_dimanfaatkan_kabupaten')->insert($starter_data);
    }
}
