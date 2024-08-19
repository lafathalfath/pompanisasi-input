<?php

namespace App\Http\Controllers\Kabupaten;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\PompaAbtDimanfaatkan;
use App\Models\PompaAbtUsulan;
use App\Models\Pompanisasi;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class KabupatenAbtController extends Controller
{
    use ArrayPaginator;

    public function usulanView() {
        $user = Auth::user();
        $kecamatan = [];
        $abt_usulan = [];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            foreach ($kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_abt_usulan as $pom) if ($pom && $pom->verified_at) {
                $abt_usulan[] = $pom;
            }
        }
        $abt_usulan = $this->paginate($abt_usulan, 10);
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

    public function diterimaView() {
        $user = Auth::user();
        $kecamatan = [];
        $abt_diterima = [];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            foreach ($kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_abt_diterima as $pom) if ($pom && $pom->verified_at) {
                $abt_diterima[] = $pom;
            }
        }
        $abt_diterima = $this->paginate($abt_diterima, 10);
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

    public function digunakanView() {
        $user = Auth::user();
        $kecamatan = [];
        $abt_digunakan = [];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            foreach ($kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_abt_dimanfaatkan as $pom) if ($pom && $pom->verified_at) {
                $abt_digunakan[] = $pom;
            }
        }
        $abt_digunakan = $this->paginate($abt_digunakan, 10);
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
