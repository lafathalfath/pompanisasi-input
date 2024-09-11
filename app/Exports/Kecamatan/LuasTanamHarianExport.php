<?php

namespace App\Exports\Kecamatan;

use App\Models\Desa;
use App\Models\LuasTanam;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LuasTanamHarianExport implements FromCollection, WithHeadings, WithStyles, WithTitle, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user = Auth::user();
        $desa = [];
        if ($user->role_id == 2 && $user->wilayah) {
            foreach ($user->wilayah->provinsi as $prov) foreach ($prov->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
        } elseif ($user->role_id == 3 && $user->provinsi) {
            foreach ($user->provinsi->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
        } elseif ($user->role_id == 4 && $user->kabupaten) {
            foreach ($user->kabupaten->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
        } elseif ($user->role_id == 5 && $user->kecamatan) {
            foreach ($user->kecamatan->desa as $des) $desa[] = $des->id;
        } elseif ($user->role_id == 6 && $user->status_verifikasi == 'terverifikasi') {
            $desa = Desa::distinct()->pluck('id');
        }
        if (!empty($desa)) {
            $luas_tanam = LuasTanam::where('verified_at', '!=', null);
            if ($user->role_id != 6) $luas_tanam = $luas_tanam->whereIn('desa_id', $desa);
            $luas_tanam = $luas_tanam->get();
            return $luas_tanam->map(function ($item, $key) {
                return [
                    'No' => $key+1,
                    'Tanggal' => $item->tanggal,
                    'Provinsi' => $item->desa->kecamatan->kabupaten->provinsi->nama,
                    'Kabupaten' => $item->desa->kecamatan->kabupaten->nama,
                    'Kecamatan' => $item->desa->kecamatan->nama,
                    'Desa' => $item->desa->nama,
                    'Kelompok Tani' => $item->nama_poktan,
                    'Luas Tanam (ha)' => $item->luas_tanam,
                    'No Hp Poktan' => $item->no_hp_poktan ? $item->no_hp_poktan : '-',
                ];
            });
        }
    }

    public function headings(): array
    {
        return [
            ['Luas Tanam Harian'],
            [
                'No',
                'Tanggal',
                'Provinsi',
                'Kabupaten',
                'Kecamatan',
                'Desa',
                'Kelompok Tani',
                'Luas Tanam (ha)',
                'No Hp Poktan',
            ],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        return [
            1 => ['font' => ['bold' => true, 'size' => 14]],
            2 => ['font' => ['bold' => true, 'size' => 12], 'alignment' => ['horizontal' => 'center']],
            'A2:I'.($sheet->getHighestRow()) => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],
        ];
    }

    public function title(): string
    {
        return 'Luas Tanam Harian';
    }

}
