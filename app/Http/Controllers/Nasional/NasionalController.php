<?php

namespace App\Http\Controllers\Nasional;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NasionalController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $rekap = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $rekap = [];
            if (!$request) {
                $rekap = [];
                foreach (Provinsi::get() as $key=>$prov) {
                    $rekap[$key] = (object) [
                        'provinsi' => $prov,
                        'luas_tanam' => 0,
                        'pompa_ref_diterima' => 0,
                        'pompa_ref_dimanfaatkan' => 0,
                        'pompa_abt_usulan' => 0,
                        'pompa_abt_diterima' => 0,
                        'pompa_abt_dimanfaatkan' => 0,
                    ];
                    foreach ($prov->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) {
                        if ($des->luas_tanam) $rekap[$key]->luas_tanam += $des->luas_tanam->luas_tanam;
                        if ($des->pompa_ref_diterima) $rekap[$key]->pompa_ref_diterima += $des->pompa_ref_diterima->total_unit;
                        if ($des->pompa_ref_dimanfaatkan) $rekap[$key]->pompa_ref_dimanfaatkan += $des->pompa_ref_dimanfaatkan->total_unit;
                        if ($des->pompa_abt_usulan) $rekap[$key]->pompa_abt_usulan += $des->pompa_abt_usulan->total_unit;
                        if ($des->pompa_abt_diterima) $rekap[$key]->pompa_abt_diterima += $des->pompa_abt_usulan->total_unit;
                        if ($des->pompa_abt_dimanfaatkan) $rekap[$key]->pompa_abt_dimanfaatkan += $des->pompa_abt_usulan->total_unit;
                    }
                }
            }
            if ($request->provinsi) {
                $rekap = [];
                $kabupaten = Kabupaten::where('provinsi_id', $request->provinsi)->get();
                foreach ($kabupaten as $key=>$kab) {
                    $rekap[$key] = (object) [
                        'kabupaten' => $kab,
                        'luas_tanam' => 0,
                        'pompa_ref_diterima' => 0,
                        'pompa_ref_dimanfaatkan' => 0,
                        'pompa_abt_usulan' => 0,
                        'pompa_abt_diterima' => 0,
                        'pompa_abt_dimanfaatkan' => 0,
                    ];
                }
                foreach ($kab->kecamatan as $key=>$kec) foreach ($kec->desa as $des) {
                    if ($des->luas_tanam) $rekap[$key]->luas_tanam += $des->luas_tanam->luas_tanam;
                    if ($des->pompa_ref_diterima) $rekap[$key]->pompa_ref_diterima += $des->pompa_ref_diterima->total_unit;
                    if ($des->pompa_ref_dimanfaatkan) $rekap[$key]->pompa_ref_dimanfaatkan += $des->pompa_ref_dimanfaatkan->total_unit;
                    if ($des->pompa_abt_usulan) $rekap[$key]->pompa_abt_usulan += $des->pompa_abt_usulan->total_unit;
                    if ($des->pompa_abt_diterima) $rekap[$key]->pompa_abt_diterima += $des->pompa_abt_usulan->total_unit;
                    if ($des->pompa_abt_dimanfaatkan) $rekap[$key]->pompa_abt_dimanfaatkan += $des->pompa_abt_usulan->total_unit;
                }
            } else if ($request->kabupaten) {
                $rekap = [];
                $kecamatan = Kecamatan::where('kabupaten_id', $request->kabupaten)->get();
                foreach ($kecamatan as $key=>$kec) {
                    $rekap[$key] = (object) [
                        'kecamatan' => $kec,
                        'luas_tanam' => 0,
                        'pompa_ref_diterima' => 0,
                        'pompa_ref_dimanfaatkan' => 0,
                        'pompa_abt_usulan' => 0,
                        'pompa_abt_diterima' => 0,
                        'pompa_abt_dimanfaatkan' => 0,
                    ];
                    foreach ($kec->desa as $des) {
                        if ($des->luas_tanam) $rekap[$key]->luas_tanam += $des->luas_tanam->luas_tanam;
                        if ($des->pompa_ref_diterima) $rekap[$key]->pompa_ref_diterima += $des->pompa_ref_diterima->total_unit;
                        if ($des->pompa_ref_dimanfaatkan) $rekap[$key]->pompa_ref_dimanfaatkan += $des->pompa_ref_dimanfaatkan->total_unit;
                        if ($des->pompa_abt_usulan) $rekap[$key]->pompa_abt_usulan += $des->pompa_abt_usulan->total_unit;
                        if ($des->pompa_abt_diterima) $rekap[$key]->pompa_abt_diterima += $des->pompa_abt_usulan->total_unit;
                        if ($des->pompa_abt_dimanfaatkan) $rekap[$key]->pompa_abt_dimanfaatkan += $des->pompa_abt_usulan->total_unit;
                    }
                }
            }
        }
        return view('nasional.dashboard', ['rekap_pompa' => $rekap]);
    }
}
