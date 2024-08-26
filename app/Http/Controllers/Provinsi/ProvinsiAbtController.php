<?php

namespace App\Http\Controllers\Provinsi;

use App\Http\Controllers\Controller;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvinsiAbtController extends Controller
{
    use ArrayPaginator;

    public function usulan() {
        $user = Auth::user();
        $usulan = [];
        if ($user->provinsi) foreach ($user->provinsi->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_abt_usulan as $pom) {
            if ($pom->verified_at) $usulan[] = $pom;
        }
        $usulan = $this->paginate($usulan, 10);
        // return view
    }

    public function diterima() {
        $user = Auth::user();
        $diterima = [];
        if ($user->provinsi) foreach ($user->provinsi->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_abt_diterima as $pom) {
            if ($pom->verified_at) $diterima[] = $pom;
        }
        $diterima = $this->paginate($diterima, 10);
        // return view
    }

    public function dimanfaatkan() {
        $user = Auth::user();
        $dimanfaatkan = [];
        if ($user->provinsi) foreach ($user->provinsi->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_abt_dimanfaatkan as $pom) {
            if ($pom->verified_at) $dimanfaatkan[] = $pom;
        }
        $dimanfaatkan = $this->paginate($dimanfaatkan, 10);
        // return view
    }
}
