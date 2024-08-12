<?php

namespace App\Http\Controllers\Kabupaten;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KabupatenAbtController extends Controller
{
    public function usulanView() {
        $user = Auth::user();
        $kecamatan = [];
        $abt_usulan = [];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            foreach ($kecamatan as $kec) {
                $poktan = 0;
                $luas_lahan = 0;
                $usulan = 0;
                foreach ($kec->desa as $des) {
                    if ($des->pompanisasi) foreach ($des->pompanisasi as $pom) {
                        if ($pom->pompa_abt_usulan) {
                            $poktan += 1;
                            $luas_lahan += $pom->pompa_abt_usulan->luas_lahan;
                            $usulan += $pom->pompa_abt_usulan->total_unit;
                        }
                    }
                }
                if ($usulan > 0) $abt_usulan[] = (object) [
                    'kecamatan' => $kec,
                    'poktan' => $poktan,
                    'luas_lahan' => $luas_lahan,
                    'usulan' => $usulan,
                ];
            }
        }
        return view('kabupaten.abt.Usulan', ['kecamatan' => $kecamatan, 'abt_usulan' => $abt_usulan]);
    }

    public function diterimaView() {
        $user = Auth::user();
        $kecamatan = [];
        $abt_diterima = [];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            foreach ($kecamatan as $kec) {
                $poktan = 0;
                $luas_lahan = 0;
                $diterima = 0;
                foreach ($kec->desa as $des) {
                    if ($des->pompanisasi) foreach ($des->pompanisasi as $pom) {
                        if ($pom->pompa_abt_usulan && $pom->pompa_abt_usulan->pompa_abt_diterima) {
                            $poktan += 1;
                            $luas_lahan += $pom->pompa_abt_usulan->luas_lahan;
                            $diterima += $pom->pompa_abt_usulan->pompa_abt_diterima->total_unit;
                        }
                    }
                }
                if ($diterima > 0) $abt_diterima[] = (object) [
                    'kecamatan' => $kec,
                    'poktan' => $poktan,
                    'luas_lahan' => $luas_lahan,
                    'diterima' => $diterima,
                ];
            }
        }
        return view('kabupaten.abt.Diterima', ['kecamatan' => $kecamatan, 'abt_diterima' => $abt_diterima]);
    }

    public function digunakanView() {
        $user = Auth::user();
        $kecamatan = [];
        $abt_digunakan = [];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            foreach ($kecamatan as $kec) {
                $poktan = 0;
                $luas_lahan = 0;
                $dimanfaatkan = 0;
                foreach ($kec->desa as $des) {
                    if ($des->pompanisasi) foreach ($des->pompanisasi as $pom) {
                        if (
                            $pom->pompa_abt_usulan 
                            && $pom->pompa_abt_usulan->pompa_abt_diterima 
                            && $pom->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan
                        ) {
                            $poktan += 1;
                            $luas_lahan += $pom->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan->luas_lahan;
                            $dimanfaatkan += $pom->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan->total_unit;
                        }
                    }
                }
                if ($dimanfaatkan > 0) $abt_digunakan[] = (object) [
                    'kecamatan' => $kec,
                    'poktan' => $poktan,
                    'luas_lahan' => $luas_lahan,
                    'dimanfaatkan' => $dimanfaatkan,
                ];
            }
        }
        return view('kabupaten.abt.Digunakan', ['kecamatan' => $kecamatan, 'abt_digunakan' => $abt_digunakan]);
    }
}
