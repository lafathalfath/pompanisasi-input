<?php
namespace App\Exports\Kecamatan;

use App\Models\PompaRefDiterima;
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
        return PompaRefDiterima::with('pompanisasi.desa')
            ->get()
            ->map(function ($item) {
                return [
                    'No' => $item->id,
                    'Desa/Kel' => $item->pompanisasi->desa->nama,
                    'Tanggal' => '-', // Placeholder jika tidak ada data tanggal
                    'Kelompok Tani' => '-', // Placeholder jika tidak ada data kelompok tani
                    'Luas Lahan (ha)' => '-', // Placeholder jika tidak ada data luas lahan
                    '3 inch (unit)' => $item->pompa_3_inch,
                    '4 inch (unit)' => $item->pompa_4_inch,
                    '6 inch (unit)' => $item->pompa_6_inch,
                    'Total Diterima' => $item->total_unit,
                    'No HP Poktan' => '08123456789', // Placeholder jika nomor HP tidak ada
                ];
            });
    }

    public function headings(): array
    {
        return [
            ['Pompa Refocusing Diterima'], // Judul di bagian atas
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
        return 'Pompa Refocusing Diterima'; // Judul sheet Excel
    }
}
