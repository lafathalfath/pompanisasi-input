<?php

namespace App\Http\Controllers\Provinsi;

use App\Http\Controllers\Controller;
use App\Models\LuasTanam;
use App\Models\PompaAbtDimanfaatkan;
use App\Models\PompaAbtDiterima;
use App\Models\PompaAbtUsulan;
use App\Models\PompaRefDimanfaatkan;
use App\Models\PompaRefDiterima;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvinsiController extends Controller
{
    use ArrayPaginator;

    public function index() {
        $user = Auth::user();
        $lth = [];
        $luas_tanam = [];
        $pompanisasi = (object) [
            'ref_diterima' => 0,
            'ref_dimanfaatkan' => 0,
            'abt_usulan' => 0,
            'abt_diterima' => 0,
            'abt_dimanfaatkan' => 0,
            'luas_tanam' => 0,
        ];
        if ($user->provinsi) {
            $kabupaten = $user->provinsi->kabupaten;
            $desa = [];
            foreach ($kabupaten as $kab) {
                $pompanisasi->ref_diterima += $kab->starter_ref_diterima_kabupaten->total_unit;
                $pompanisasi->ref_dimanfaatkan += $kab->starter_ref_dimanfaatkan_kabupaten->total_unit;
                $pompanisasi->abt_usulan += $kab->starter_abt_usulan_kabupaten->total_unit;
                $pompanisasi->abt_diterima += $kab->starter_abt_diterima_kabupaten->total_unit;
                $pompanisasi->abt_dimanfaatkan += $kab->starter_abt_dimanfaatkan_kabupaten->total_unit;
                $pompanisasi->luas_tanam += $kab->starter_luas_tanam_kabupaten->luas_tanam;
                foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            }
            $pompanisasi->ref_diterima += PompaRefDiterima::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('total_unit');
            $pompanisasi->ref_dimanfaatkan += PompaRefDimanfaatkan::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('total_unit');
            $pompanisasi->abt_usulan += PompaAbtUsulan::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('total_unit');
            $pompanisasi->abt_diterima += PompaAbtDiterima::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('total_unit');
            $pompanisasi->abt_dimanfaatkan += PompaAbtDimanfaatkan::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('total_unit');
            $pompanisasi->luas_tanam += LuasTanam::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('luas_tanam');
            $lth = LuasTanam::whereIn('desa_id', $desa)
                ->where('verified_at', '!=', null)
                ->selectRaw('tanggal, SUM(luas_tanam) as total')
                ->groupBy('tanggal')
                ->orderBy('tanggal', 'asc')
                ->get();
            foreach ($lth as $l) $luas_tanam[$l->tanggal] = $l->total;
        }
        return view('provinsi.dashboard', ['pompanisasi' => $pompanisasi, 'luas_tanam' => $luas_tanam]);
    }
}
