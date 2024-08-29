<?php

namespace App\Http\Controllers\Wilayah;

use App\Http\Controllers\Controller;
use App\Models\PompaAbtDimanfaatkan;
use App\Models\PompaAbtDiterima;
use App\Models\PompaAbtUsulan;
use App\Models\Provinsi;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class WilayahAbtController extends Controller
{
    use ArrayPaginator;

    public function usulan(Request $request) {
        $user = Auth::user();
        $provinsi = $user->wilayah ? $user->wilayah->provinsi : [];
        $abt_usulan = [];
        if ($user->wilayah) {
            $desa = [];
            foreach ($provinsi as $prov) foreach ($prov->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->provinsi) {
                $desa = [];
                foreach (Provinsi::find($request->provinsi)->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            }
            $abt_usulan = PompaAbtUsulan::whereIn('desa_id', $desa)->where('verified_at', '!=', null);
            if ($request->tanggal) $abt_usulan = $abt_usulan->where('tanggal', $request->tanggal);
            $abt_usulan = $abt_usulan->paginate(10);
        }
        return view('wilayah.abt.usulan', ['provinsi' => $provinsi, 'abt_usulan' => $abt_usulan]);
    }

    public function diterima(Request $request) {
        $user = Auth::user();
        $provinsi = $user->wilayah ? $user->wilayah->provinsi : [];
        $abt_diterima = [];
        if ($user->wilayah) {
            $desa = [];
            foreach ($provinsi as $prov) foreach ($prov->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->provinsi) {
                $desa = [];
                foreach (Provinsi::find($request->provinsi)->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            }
            $abt_diterima = PompaAbtDiterima::whereIn('desa_id', $desa)->where('verified_at', '!=', null);
            if ($request->tanggal) $abt_diterima = $abt_diterima->where('tanggal', $request->tanggal);
            $abt_diterima = $abt_diterima->paginate(10);
        }
        return view('wilayah.abt.diterima', ['provinsi' => $provinsi, 'abt_diterima' => $abt_diterima]);
    }

    public function detailDiterima($id) {
        $abt_diterima = PompaAbtDiterima::find(Crypt::decryptString($id));
        return view('wilayah.abt.detail_diterima', ['abt_diterima' => $abt_diterima]);
    }

    public function dimanfaatkan(Request $request) {
        $user = Auth::user();
        $provinsi = $user->wilayah ? $user->wilayah->provinsi : [];
        $abt_dimanfaatkan = [];
        if ($user->wilayah) {
            $desa = [];
            foreach ($provinsi as $prov) foreach ($prov->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->provinsi) {
                $desa = [];
                foreach (Provinsi::find($request->provinsi)->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            }
            $abt_dimanfaatkan = PompaAbtDimanfaatkan::whereIn('desa_id', $desa)->where('verified_at', '!=', null);
            if ($request->tanggal) $abt_dimanfaatkan = $abt_dimanfaatkan->where('tanggal', $request->tanggal);
            $abt_dimanfaatkan = $abt_dimanfaatkan->paginate(10);
        }
        return view('wilayah.abt.digunakan', ['provinsi' => $provinsi, 'abt_dimanfaatkan' => $abt_dimanfaatkan]);
    }

    public function detailDimanfaatkan($id) {
        $abt_dimanfaatkan = PompaAbtDimanfaatkan::find(Crypt::decryptString($id));
        return view('wilayah.abt.detail_digunakan', ['abt_dimanfaatkan' => $abt_dimanfaatkan]);
    }
}
