<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinsi = [
            // wilayah I
            ['id' => 1, 'pj_id' => null, 'wilayah_id' => 1, 'nama' => 'Aceh'],
            ['id' => 2, 'pj_id' => null, 'wilayah_id' => 1, 'nama' => 'Sumatra Utara (Sumut)'],
            ['id' => 3, 'pj_id' => null, 'wilayah_id' => 1, 'nama' => 'Sumatra Barat (Sumbar)'],
            ['id' => 4, 'pj_id' => null, 'wilayah_id' => 1, 'nama' => 'Riau'],
            ['id' => 5, 'pj_id' => null, 'wilayah_id' => 1, 'nama' => 'Jambi'],
            ['id' => 6, 'pj_id' => null, 'wilayah_id' => 1, 'nama' => 'Sumatra Selatan (Sumsel)'],
            ['id' => 7, 'pj_id' => null, 'wilayah_id' => 1, 'nama' => 'Bengkulu'],
            ['id' => 8, 'pj_id' => null, 'wilayah_id' => 1, 'nama' => 'Bangka Belitung (Babel)'],
            ['id' => 9, 'pj_id' => null, 'wilayah_id' => 1, 'nama' => 'Lampung'],
            
            // wilayah II
            ['id' => 10, 'pj_id' => null, 'wilayah_id' => 2, 'nama' => 'Banten'],
            ['id' => 11, 'pj_id' => null, 'wilayah_id' => 2, 'nama' => 'Jawa Barat (Jabar)'],
            ['id' => 12, 'pj_id' => null, 'wilayah_id' => 2, 'nama' => 'Yogyakarta'],
            ['id' => 13, 'pj_id' => null, 'wilayah_id' => 2, 'nama' => 'Jawa Tengah (Jateng)'],
            ['id' => 14, 'pj_id' => null, 'wilayah_id' => 2, 'nama' => 'Jawa Timur (Jatim)'],
            
            // wilayah III
            ['id' => 15, 'pj_id' => null, 'wilayah_id' => 3, 'nama' => 'Bali'],
            ['id' => 16, 'pj_id' => null, 'wilayah_id' => 3, 'nama' => 'Nusa Tenggara Barat (NTB)'],
            ['id' => 17, 'pj_id' => null, 'wilayah_id' => 3, 'nama' => 'Kalimantan Selatan (Kalsel)'],
            ['id' => 18, 'pj_id' => null, 'wilayah_id' => 3, 'nama' => 'Kalimantan Barat (Kalbar)'],
            ['id' => 19, 'pj_id' => null, 'wilayah_id' => 3, 'nama' => 'Kalimantan Tengah (Kalteng)'],
            ['id' => 20, 'pj_id' => null, 'wilayah_id' => 3, 'nama' => 'Kalimantan Timur (Kaltim)'],
            ['id' => 21, 'pj_id' => null, 'wilayah_id' => 3, 'nama' => 'Kalimantan Utara (Kaltara)'],
            
            // wilayah IV
            ['id' => 22, 'pj_id' => null, 'wilayah_id' => 4, 'nama' => 'Nusa Tenggara Timur (NTT)'],
            ['id' => 23, 'pj_id' => null, 'wilayah_id' => 4, 'nama' => 'Sulawesi Utara (Sulut)'],
            ['id' => 24, 'pj_id' => null, 'wilayah_id' => 4, 'nama' => 'Sulawesi Barat (Sulbar)'],
            ['id' => 25, 'pj_id' => null, 'wilayah_id' => 4, 'nama' => 'Sulawesi Tenggara (Sultra)'],
            ['id' => 26, 'pj_id' => null, 'wilayah_id' => 4, 'nama' => 'Sulawesi Tengah (Sulteng)'],
            ['id' => 27, 'pj_id' => null, 'wilayah_id' => 4, 'nama' => 'Sulawesi Selatan (Sulsel)'],
            ['id' => 28, 'pj_id' => null, 'wilayah_id' => 4, 'nama' => 'Gorontalo'],
            ['id' => 29, 'pj_id' => null, 'wilayah_id' => 4, 'nama' => 'Maluku'],
            ['id' => 30, 'pj_id' => null, 'wilayah_id' => 4, 'nama' => 'Maluku Utara (Malut)'],
            ['id' => 31, 'pj_id' => null, 'wilayah_id' => 4, 'nama' => 'Papua'],
            ['id' => 32, 'pj_id' => null, 'wilayah_id' => 4, 'nama' => 'Papua Barat'],
            ['id' => 33, 'pj_id' => null, 'wilayah_id' => 4, 'nama' => 'Papua Selatan'],
            ['id' => 34, 'pj_id' => null, 'wilayah_id' => 4, 'nama' => 'Papua Tengah'],
            ['id' => 35, 'pj_id' => null, 'wilayah_id' => 4, 'nama' => 'Papua Barat Daya'],
        ];

        DB::table('provinsi')->insert($provinsi);
    }
}
