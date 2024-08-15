<?php
namespace App\Exports\Kecamatan;

use App\Models\Pompanisasi;
use App\Models\PompaRefDiterima;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PompaRefDiterimaExport implements FromCollection, WithHeadings, WithStyles, WithTitle, ShouldAutoSize
{
    public function collection()
    {
        $user = Auth::user();
        $desa = [];
        if ($user->role_id == 2) {
            foreach ($user->wilayah->provinsi as $prov) foreach ($prov->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) {
                $desa[] = $des->id;
            }
        }
        elseif ($user->role_id == 3) {
            foreach ($user->provinsi->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) {
                $desa[] = $des->id;
            }
        }
        elseif ($user->role_id == 4) {
            foreach ($user->kabupaten->kecamatan as $kec) foreach ($kec->desa as $des) {
                $desa[] = $des->id;
            }
        }
        elseif ($user->role_id == 5) {
            foreach ($user->kecamatan->desa as $des) {
                $desa[] = $des->id;
            }
        }
        if (!empty($desa)) {
            $pompanisasi = Pompanisasi::whereIn('desa_id', $desa)
                ->where('verified_at', '!=', null)
                ->get();
            $id_pompa = [];
            foreach ($pompanisasi as $pom) if (
                $pom->pompa_ref_diterima 
                && $pom->pompa_ref_diterima->pompa_ref_dimanfaatkan
                && $pom->pompa_abt_usulan
                && $pom->pompa_abt_usulan->pompa_abt_diterima
                && $pom->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan
            ) $id_pompa[] =  $pom->id;
            
            return PompaRefDiterima::whereIn('pompanisasi_id', $id_pompa)
                ->get()
                ->map(function ($item, $key) {
                    // dd($key);
                    return [
                        'No' => $key+1,
                        'Provinsi' => $item->pompanisasi->desa->kecamatan->kabupaten->provinsi->nama,
                        'Kabupaten/Kota' => $item->pompanisasi->desa->kecamatan->kabupaten->nama,
                        'Kecamatan' => $item->pompanisasi->desa->kecamatan->nama,
                        'Desa/Kel' => $item->pompanisasi->desa->nama,
                        'Tanggal' => '-', // Placeholder jika tidak ada data tanggal
                        'Kelompok Tani' => '-', // Placeholder jika tidak ada data kelompok tani
                        'Luas Lahan (ha)' => '-', // Placeholder jika tidak ada data luas lahan
                        '3 inch (unit)' => $item->pompa_3_inch ? $item->pompa_3_inch : '0',
                        '4 inch (unit)' => $item->pompa_4_inch ? $item->pompa_4_inch :'0',
                        '6 inch (unit)' => $item->pompa_6_inch ? $item->pompa_6_inch : '0',
                        'Total Diterima' => $item->total_unit ? $item->total_unit : '0',
                        'No HP Poktan' => '-', // Placeholder jika nomor HP tidak ada
                    ];
                });
            // foreach ($pompanisasi as $key=>$pom) if (
            //     $pom->pompa_ref_diterima
            //     && $pom->pompa_ref_diterima->pompa_ref_dimanfaatkan
            // ) {
            //     $ref_diterima = $pom->pompa_ref_diterima;
            //     return [
            //         'No' => $key+1,
            //         'Desa/Kel' => $pom->desa->nama,
            //         'Tanggal' => '-', // Placeholder jika tidak ada data tanggal
            //         'Kelompok Tani' => '-', // Placeholder jika tidak ada data kelompok tani
            //         'Luas Lahan (ha)' => '-', // Placeholder jika tidak ada data luas lahan
            //         '3 inch (unit)' => $ref_diterima->pompa_3_inch,
            //         '4 inch (unit)' => $ref_diterima->pompa_4_inch,
            //         '6 inch (unit)' => $ref_diterima->pompa_6_inch,
            //         'Total Diterima' => $ref_diterima->total_unit,
            //         'No HP Poktan' => '-', // Placeholder jika nomor HP tidak ada
            //     ];
            // }
        }
        // return PompaRefDiterima::with('pompanisasi.desa')
        //     ->get()
        //     ->map(function ($item) {
        //         return [
        //             'No' => $item->id,
        //             'Desa/Kel' => $item->pompanisasi->desa->nama,
        //             'Tanggal' => '-', // Placeholder jika tidak ada data tanggal
        //             'Kelompok Tani' => '-', // Placeholder jika tidak ada data kelompok tani
        //             'Luas Lahan (ha)' => '-', // Placeholder jika tidak ada data luas lahan
        //             '3 inch (unit)' => $item->pompa_3_inch,
        //             '4 inch (unit)' => $item->pompa_4_inch,
        //             '6 inch (unit)' => $item->pompa_6_inch,
        //             'Total Diterima' => $item->total_unit,
        //             'No HP Poktan' => '08123456789', // Placeholder jika nomor HP tidak ada
        //         ];
        //     });
    }

    public function headings(): array
    {
        return [
            ['Pompa Refocusing Diterima'], // Judul di bagian atas
            [
                'No',
                'Provinsi',
                'Kabupaten',
                'Kecamatan',
                'Desa/Kel',
                'Tanggal',
                'Kelompok Tani',
                'Luas Lahan (ha)',
                '3 inch (unit)',
                '4 inch (unit)',
                '6 inch (unit)',
                'Total Diterima',
                'No HP Poktan',
            ]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Merge cells from A1 to J1 and center the text
        $sheet->mergeCells('A1:M1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        return [
            // Mengatur judul di atas tabel
            1    => ['font' => ['bold' => true, 'size' => 14]],

            // Mengatur heading tabel
            2    => ['font' => ['bold' => true, 'size' => 12], 'alignment' => ['horizontal' => 'center']],

            // Border untuk tabel
            'A2:M' . ($sheet->getHighestRow()) => [
                'borders' => [
                    'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                ],
            ],
        ];
    }

    public function title(): string
    {
        return 'Pompa Refocusing Diterima'; // Judul sheet Excel
    }
}
