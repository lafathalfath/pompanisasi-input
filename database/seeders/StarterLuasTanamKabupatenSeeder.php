<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StarterLuasTanamKabupatenSeeder extends Seeder
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
                'luas_tanam' => 0,
            ];
        }

        DB::table('starter_luas_tanam_kabupaten')->insert($starter_data);
    }
}
