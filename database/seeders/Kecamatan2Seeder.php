<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Kecamatan2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_path = storage_path('/app/data_region/districts.csv');
        $csv_file = fopen($file_path, 'r');
        $header = fgetcsv($csv_file); // bypass first row

        $kecamatan = [];
        while (($row = fgetcsv($csv_file)) !== false) {
            $kecamatan[] = [
                'id' => $row[0],
                'pj_id' => null,
                'kabupaten_id' => $row[1],
                'nama' => $row[2],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        fclose($csv_file);

        DB::table('kecamatan')->insert($kecamatan);
    }
}
