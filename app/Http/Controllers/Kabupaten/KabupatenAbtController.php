<?php

namespace App\Http\Controllers\Kabupaten;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\PompaAbtDimanfaatkan;
use App\Models\PompaAbtDiterima;
use App\Models\PompaAbtUsulan;
use App\Models\Pompanisasi;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class KabupatenAbtController extends Controller
{
    use ArrayPaginator;

    public function usulanView(Request $request) {
        $user = Auth::user();
        $kecamatan = [];
        $abt_usulan = [];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            $desa = [];
            foreach ($kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->kecamatan) $desa = Desa::where('kecamatan_id', $request->kecamatan)->distinct()->pluck('id');
            $abt_usulan = PompaAbtUsulan::whereIn('desa_id', $desa);
            if ($request->tanggal) $abt_usulan = $abt_usulan->where('tanggal', $request->tanggal);
            $abt_usulan = $abt_usulan->where('verified_at', '!=', null)->paginate(10);
        }
        return view('kabupaten.abt.Usulan', ['kecamatan' => $kecamatan, 'abt_usulan' => $abt_usulan]);
    }

    public function detailUsulanView($kec_id) {
        $kecamatan = Kecamatan::find(Crypt::decryptString($kec_id));
        $desa = [];
        $abt_usulan = [];
        if ($kecamatan) {
            $desa = $kecamatan->desa;
            foreach ($desa as $des) {
                foreach ($des->pompanisasi as $pom) {
                    if ($pom->pompa_abt_usulan) $abt_usulan[] = $pom->pompa_abt_usulan;
                }
            }
        }
        return view('kabupaten.abt.abt_detail_kecamatan_usulan', ['desa' => $desa, 'abt_usulan' => $abt_usulan]);
    }

    public function diterimaView(Request $request) {
        $user = Auth::user();
        $kecamatan = [];
        $abt_diterima = [];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            $desa = [];
            foreach ($kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->kecamatan) $desa = Desa::where('kecamatan_id', $request->kecamatan)->distinct()->pluck('id');
            $abt_diterima = PompaAbtDiterima::whereIn('desa_id', $desa);
            if ($request->tanggal) $abt_diterima = $abt_diterima->where('tanggal', $request->tanggal);
            $abt_diterima = $abt_diterima->where('verified_at', '!=', null)->paginate(10);
        }
        return view('kabupaten.abt.Diterima', ['kecamatan' => $kecamatan, 'abt_diterima' => $abt_diterima]);
    }

    public function detailDiterimaView($kec_id) {
        $kecamatan = Kecamatan::find(Crypt::decryptString($kec_id));
        $desa = [];
        $abt_diterima = [];
        if ($kecamatan) {
            $desa = $kecamatan->desa;
            foreach ($desa as $des) {
                foreach ($des->pompanisasi as $pom) {
                    if ($pom->pompa_abt_usulan && $pom->pompa_abt_usulan->pompa_abt_diterima) $abt_diterima[] = $pom->pompa_abt_usulan->pompa_abt_diterima;
                }
            }
        }
        return view('kabupaten.abt.abt_detail_kecamatan_diterima', ['desa' => $desa, 'abt_diterima' => $abt_diterima]);
    }

    public function digunakanView(Request $request) {
        $user = Auth::user();
        $kecamatan = [];
        $abt_digunakan = [];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            $desa = [];
            foreach ($kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->kecamatan) $desa = Desa::where('kecamatan_id', $request->kecamatan)->distinct()->pluck('id');
            $abt_digunakan = PompaAbtDimanfaatkan::whereIn('desa_id', $desa);
            if ($request->tanggal) $abt_digunakan = $abt_digunakan->where('tanggal', $request->tanggal);
            $abt_digunakan = $abt_digunakan->where('verified_at', '!=', null)->paginate(10);
        }
        return view('kabupaten.abt.Digunakan', ['kecamatan' => $kecamatan, 'abt_digunakan' => $abt_digunakan]);
    }
    
    public function detailDigunakanView($kec_id) {
        $kecamatan = Kecamatan::find(Crypt::decryptString($kec_id));
        $desa = [];
        $abt_dimanfaatkan = [];
        if ($kecamatan) {
            $desa = $kecamatan->desa;
            foreach ($desa as $des) {
                foreach ($des->pompanisasi as $pom) {
                    if ($pom->pompa_abt_usulan && $pom->pompa_abt_usulan->pompa_abt_diterima && $pom->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan) $abt_dimanfaatkan[] = $pom->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan;
                }
            }
        }
        return view('kabupaten.abt.abt_detail_kecamatan_digunakan', ['desa' => $desa, 'abt_dimanfaatkan' => $abt_dimanfaatkan]);
    }

    public function detailDigunakanDetail($id) {
        $abt_dimanfaatkan = PompaAbtDimanfaatkan::find(Crypt::decryptString($id));
        return view('kabupaten.abt.detail_dimanfaatkan', ['abt_dimanfaatkan' => $abt_dimanfaatkan]);
    }
}
