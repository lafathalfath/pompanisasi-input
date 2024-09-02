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
            foreach ($kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            $pompanisasi->ref_diterima = PompaRefDiterima::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('total_unit');
            $pompanisasi->ref_dimanfaatkan = PompaRefDimanfaatkan::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('total_unit');
            $pompanisasi->abt_usulan = PompaAbtUsulan::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('total_unit');
            $pompanisasi->abt_diterima = PompaAbtDiterima::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('total_unit');
            $pompanisasi->abt_dimanfaatkan = PompaAbtDimanfaatkan::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('total_unit');
            $pompanisasi->luas_tanam = LuasTanam::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('luas_tanam');
        }
        return view('provinsi.dashboard', ['pompanisasi' => $pompanisasi]);
    }
}
