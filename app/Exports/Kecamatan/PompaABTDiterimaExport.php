<?php
namespace App\Exports\Kecamatan;

use App\Models\PompaAbtDiterima;
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
        return PompaAbtDiterima::with('pompa_abt_usulan.pompanisasi.desa')
            ->get()
            ->map(function ($item) {
                return [
                    'No' => $item->id,
                    'Desa/Kel' => $item->pompa_abt_usulan->pompanisasi->desa->nama,
                    'Tanggal' => $item->pompa_abt_usulan->tanggal,
                    'Kelompok Tani' => $item->pompa_abt_usulan->nama_poktan,
                    'Luas Lahan (ha)' => $item->pompa_abt_usulan->luas_lahan,
                    '3 inch (unit)' => $item->pompa_3_inch,
                    '4 inch (unit)' => $item->pompa_4_inch,
                    '6 inch (unit)' => $item->pompa_6_inch,
                    'Total Diterima' => $item->total_unit,
                    'No HP Poktan' => $item->pompa_abt_usulan->no_hp_poktan,
                ];
            });
    }

    public function headings(): array
    {
        return [
            ['Pompa ABT Diterima'], // Judul di bagian atas
            [
                'No',
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
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        return [
            // Mengatur judul di atas tabel
            1    => ['font' => ['bold' => true, 'size' => 14]],

            // Mengatur heading tabel
            2    => ['font' => ['bold' => true, 'size' => 12], 'alignment' => ['horizontal' => 'center']],

            // Border untuk tabel
            'A2:J' . ($sheet->getHighestRow()) => [
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
