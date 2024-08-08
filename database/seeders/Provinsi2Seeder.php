<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Provinsi2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_path = storage_path('/app/data_region/provinces.csv');
        $csv_file = fopen($file_path, 'r');
        $header = fgetcsv($csv_file); // bypass first row

        $provinsi = [];
        while (($row = fgetcsv($csv_file)) !== false) {
            $provinsi[] = [
                'id' => $row[0],
                'pj_id' => null,
                'wilayah_id' => $row[1],
                'nama' => $row[2],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        fclose($csv_file);
        DB::table('provinsi')->insert($provinsi);
    }
}
