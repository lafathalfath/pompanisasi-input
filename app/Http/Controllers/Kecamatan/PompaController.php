<?php

namespace App\Http\Controllers\Kecamatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PompaController extends Controller
{
    public function refDiterimaView() {
        $user = Auth::user();
        $ref_diterima = [];
        if ($user->kecamatan) {
            foreach ($user->kecamatan->desa as $des) {
                foreach ($des->pompanisasi as $pom) {
                    if ($pom->pompa_ref_diterima) $ref_diterima[] = $pom->pompa_ref_diterima;
                }
            }
        }
        return view('kecamatan.refocusing.diterima', ['desa' => $user->kecamatan->desa, 'ref_diterima' => $ref_diterima]);
    }

    public function refDigunakanView() {
        $user = Auth::user();
        $ref_dimanfaatkan = [];
        if ($user->kecamatan) {
            foreach ($user->kecamatan->desa as $des) {
                foreach ($des->pompanisasi as $pom) {
                    if ($pom->pompa_ref_dimanfaatkan) $ref_dimanfaatkan[] = $pom->pompa_ref_dimanfaatkan;
                }
            }
        }
        return view('kecamatan.refocusing.digunakan', ['desa' => $user->kecamatan->desa, 'ref_dimanfaatkan' => $ref_dimanfaatkan]);
    }
    public function abtUsulanView() {
        return view('kecamatan.abt.usulan');
    }
    public function abtDiterimaView() {
        return view('kecamatan.abt.diterima');
    }
    public function abtDigunakanView() {
        return view('kecamatan.abt.digunakan');
    }
    public function refocusingUsulan() {
        return view('kecamatan.pompaRefocusingUsulanForm');
    }

    public function refocusingDiterima() {
        return view('kecamatan.pompaRefocusingDiterimaForm');
    }
    public function refocusingDigunakan() {
        $user = Auth::user();
        $desa = $user->kecamatan->desa;
        return view('kecamatan.pompaRefocusingDigunakanForm', ['desa' => $desa]);
    }
    public function abtUsulan() {
        return view('kecamatan.pompaAbtUsulanForm');
    }
    public function abtDiterima() {
        return view('kecamatan.pompaAbtDiterimaForm');
    }
    public function abtDigunakan() {
        return view('kecamatan.pompaAbtDigunakanForm');
    }
}
