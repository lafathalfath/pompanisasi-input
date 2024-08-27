<?php
namespace App\Exports\Kecamatan;

use App\Models\Desa;
use App\Models\PompaAbtDiterima;
use App\Models\Pompanisasi;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PompaAbtDiterimaExport implements FromCollection, WithHeadings, WithStyles, WithTitle, ShouldAutoSize
{
    public function collection()
    {
        $user = Auth::user();
        $desa = [];
        if ($user->role_id == 2 && $user->wilayah) {
            foreach ($user->wilayah->provinsi as $prov) foreach ($prov->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) {
                $desa[] = $des->id;
            }
        }
        elseif ($user->role_id == 3 && $user->provinsi) {
            foreach ($user->provinsi->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) {
                $desa[] = $des->id;
            }
        }
        elseif ($user->role_id == 4 && $user->kabupaten) {
            foreach ($user->kabupaten->kecamatan as $kec) foreach ($kec->desa as $des) {
                $desa[] = $des->id;
            }
        }
        elseif ($user->role_id == 5 && $user->kecamatan) {
            foreach ($user->kecamatan->desa as $des) {
                $desa[] = $des->id;
            }
        }
        elseif ($user->role_id == 6 && $user->status_verifikasi == 'terverifikasi') {
            $desa = Desa::distinct()->pluck('id');
        }

        if (!empty($desa)) {
            $abt_diterima = PompaAbtDiterima::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->get();
            return $abt_diterima->map(function ($item, $key) {
                return [
                    'No' => $key+1,
                    'Provinsi' => $item->desa->kecamatan->kabupaten->provinsi->nama,
                    'Kabupaten' => $item->desa->kecamatan->kabupaten->nama,
                    'Kecamatan' => $item->desa->kecamatan->nama,
                    'Desa/Kel' => $item->desa->nama,
                    'Tanggal' => $item->tanggal ? $item->tanggal : '-',
                    'Kelompok Tani' => $item->nama_poktan ? $item->nama_poktan :'-',
                    'Luas Lahan (ha)' => $item->luas_lahan ? $item->luas_lahan : '0',
                    '3 inch (unit)' => $item->pompa_3_inch ? $item->pompa_3_inch : '0',
                    '4 inch (unit)' => $item->pompa_4_inch ? $item->pompa_4_inch : '0',
                    '6 inch (unit)' => $item->pompa_6_inch ? $item->pompa_6_inch : '0',
                    'Total Dimanfaatkan' => $item->total_unit ? $item->total_unit : '0',
                    'No HP Poktan' => $item->no_hp_poktan ? $item->no_hp_poktan : '-',
                ];
            });
        }

        // if (!empty($desa)) {
        //     $abt_diterima = PompaAbtDiterima::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->get();
        //     foreach ($abt_diterima as $key=>$item) {
        //         return [
        //             'No' => $key+1,
        //             'Provinsi' => $item->pompa_abt_usulan->pompanisasi->desa->kecamatan->kabupaten->provinsi->nama,
        //             'Kabupaten' => $item->pompa_abt_usulan->pompanisasi->desa->kecamatan->kabupaten->nama,
        //             'Kecamatan' => $item->pompa_abt_usulan->pompanisasi->desa->kecamatan->nama,
        //             'Desa/Kel' => $item->pompa_abt_usulan->pompanisasi->desa->nama,
        //             'Tanggal' => $item->tanggal ? $item->tanggal : '-',
        //             'Kelompok Tani' => $item->nama_poktan ? $item->nama_poktan :'-',
        //             'Luas Lahan (ha)' => $item->luas_lahan ? $item->luas_lahan : '0',
        //             '3 inch (unit)' => $item->pompa_3_inch ? $item->pompa_3_inch : '0',
        //             '4 inch (unit)' => $item->pompa_4_inch ? $item->pompa_4_inch : '0',
        //             '6 inch (unit)' => $item->pompa_6_inch ? $item->pompa_6_inch : '0',
        //             'Total Dimanfaatkan' => $item->total_unit ? $item->total_unit : '0',
        //             'No HP Poktan' => $item->no_hp_poktan ? $item->no_hp_poktan : '-',
        //         ];
        //     }
        // }

        // if (!empty($desa)) foreach ($desa as $des) {
        //     return $des->pompa_abt_diterima
        //         ->map(function ($item, $key) {
        //             return [
        //                 'No' => $key+1,
        //                 'Provinsi' => $item->pompa_abt_usulan->pompanisasi->desa->kecamatan->kabupaten->provinsi->nama,
        //                 'Kabupaten' => $item->pompa_abt_usulan->pompanisasi->desa->kecamatan->kabupaten->nama,
        //                 'Kecamatan' => $item->pompa_abt_usulan->pompanisasi->desa->kecamatan->nama,
        //                 'Desa/Kel' => $item->pompa_abt_usulan->pompanisasi->desa->nama,
        //                 'Tanggal' => $item->tanggal ? $item->tanggal : '-',
        //                 'Kelompok Tani' => $item->nama_poktan ? $item->nama_poktan :'-',
        //                 'Luas Lahan (ha)' => $item->luas_lahan ? $item->luas_lahan : '0',
        //                 '3 inch (unit)' => $item->pompa_3_inch ? $item->pompa_3_inch : '0',
        //                 '4 inch (unit)' => $item->pompa_4_inch ? $item->pompa_4_inch : '0',
        //                 '6 inch (unit)' => $item->pompa_6_inch ? $item->pompa_6_inch : '0',
        //                 'Total Dimanfaatkan' => $item->total_unit ? $item->total_unit : '0',
        //                 'No HP Poktan' => $item->no_hp_poktan ? $item->no_hp_poktan : '-',
        //             ];
        //         });
        // }
    }

    public function headings(): array
    {
        return [
            ['Pompa ABT Diterima'], // Judul di bagian atas
            [
                'No',
                'Provinsi',
                'Kabupaten/Kota',
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
        return 'Pompa ABT Diterima'; // Judul sheet Excel
    }
}
