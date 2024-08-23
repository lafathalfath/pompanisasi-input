<?php

namespace App\Http\Controllers\Kabupaten;

use App\Http\Controllers\Controller;
use App\Models\PompaAbtDimanfaatkan;
use App\Models\PompaAbtDiterima;
use App\Models\PompaAbtUsulan;
use App\Models\PompaRefDimanfaatkan;
use App\Models\PompaRefDiterima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class VerifikasiDataController extends Controller
{
    public function refDiterimaView() {
        $user = Auth::user();
        $ref_diterima = [];
        if ($user->kabupaten) foreach ($user->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_ref_diterima as $rdt) {
            $ref_diterima[] = $rdt;
        }
        // return view
    }

    public function refDimanfaatkanView() {
        $user = Auth::user();
        $ref_dimanfaatkan = [];
        if ($user->kabupaten) foreach ($user->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_ref_dimanfaatkan as $rdm) {
            $ref_dimanfaatkan[] = $rdm;
        }
        // return view
    }

    public function abtUsulanView() {
        $user = Auth::user();
        $abt_usulan = [];
        if ($user->kabupaten) foreach ($user->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_abt_usulan as $aus) {
            $abt_usulan[] = $aus;
        }
        // return view
    }

    public function abtDiterimaView() {
        $user = Auth::user();
        $abt_diterima = [];
        if ($user->kabupaten) foreach ($user->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_abt_diterima as $adt) {
            $abt_diterima[] = $adt;
        }
        // return view
    }

    public function abtDimanfaatkanView() {
        $user = Auth::user();
        $abt_dimanfaatkan = [];
        if ($user->kabupaten) foreach ($user->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_abt_dimanfaatkan as $adm) {
            $abt_dimanfaatkan[] = $adm;
        }
        // return view
    }

    // verification
    public function refDiterimaVerif($id) {
        $id = Crypt::decryptString($id);
        $ref_diterima = PompaRefDiterima::find($id);
        $ref_diterima->update(['verified_at' => now()]);
    }

    public function refDimanfaatkanVerif($id) {
        $id = Crypt::decryptString($id);
        $ref_dimanfaatkan = PompaRefDimanfaatkan::find($id);
        $ref_dimanfaatkan->update(['verified_at' => now()]);
    }

    public function abtUsulanVerif($id) {
        $id = Crypt::decryptString($id);
        $abt_usulan = PompaAbtUsulan::find($id);
        $abt_usulan->update(['verified_at' => now()]);
    }

    public function abtDiterimaVerif($id) {
        $id = Crypt::decryptString($id);
        $abt_diterima = PompaAbtDiterima::find($id);
        $abt_diterima->update(['verified_at' => now()]);
    }

    public function abtDimanfaatkanVerif($id) {
        $id = Crypt::decryptString($id);
        $abt_dimanfaatkan = PompaAbtDimanfaatkan::find($id);
        $abt_dimanfaatkan->update(['verified_at' => now()]);
    }
}
