<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Kabupaten2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_path = storage_path('/app/data_region/regencies.csv');
        $csv_file = fopen($file_path, 'r');
        $header = fgetcsv($csv_file); // bypass first row

        $kabupaten = [];
        while (($row = fgetcsv($csv_file)) !== false) {
            // dd($row);
            $kabupaten[] = [
                'id' => $row[0],
                'pj_id' => null,
                'provinsi_id' => $row[1],
                'nama' => $row[2],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // dd($kabupaten);
        fclose($csv_file);
        DB::table('kabupaten')->insert($kabupaten);
    }
}
