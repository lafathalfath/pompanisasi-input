<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk mengimpor kelas DB

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinsi_dasboard')->insert([
            [
                'provinsi' => 'jawa barat',
                'desa' => 'Pasir Jaya',
                'nama_poktan' => 'qona',
                'luas_tanam' => 41,
                'pompa_refocusing_usulan' => 12,
                'pompa_refocusing_diterima' => 12,
                'pompa_refocusing_digunakan' => 10,
                'pompa_abt_usulan' => 11,
                'pompa_abt_diterima' => 9,
                'pompa_abt_digunakan' => 8,
            ],
            // Tambahkan data lainnya sesuai kebutuhan
        ]);
    }
}
