<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Desa2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_path = storage_path('/app/data_region/villages.csv');
        $csv_file = fopen($file_path, 'r');
        $header = fgetcsv($csv_file); // bypass first row

        $desa = [];
        $desa_index = 0;
        while (($row = fgetcsv($csv_file)) !== false) {
            if (!empty($desa) && count($desa[$desa_index]) > 12899) $desa_index++;
            $desa[$desa_index][] = [
                'id' => $row[0],
                'kecamatan_id' => $row[1],
                'nama' => $row[2],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        fclose($csv_file);
        foreach ($desa as $ds) {
            DB::table('desa')->insert($ds);
        }
    }
}
