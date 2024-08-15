<?php

namespace App\Http\Controllers\Kabupaten;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Pompanisasi;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class KabupatenController extends Controller
{
    use ArrayPaginator;

    public function index() {
        $user = Auth::user();
        $kecamatan = [];
        $luas_tanam_harian = [];
        // $ref_diterima = 0;
        // $ref_dimanfaatkan = 0;
        // $abt_usulan = 0;
        // $abt_diterima = 0;
        // $abt_dimanfaatkan = 0;
        $pompanisasi = (object) [
            'ref_diterima' => 0,
            'ref_dimanfaatkan' => 0,
            'abt_usulan' => 0,
            'abt_diterima' => 0,
            'abt_dimanfaatkan' => 0,
        ];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            foreach ($kecamatan as $kec) {
                // $luas_tanam = 0;
                foreach ($kec->desa as $des) {
                    if ($des->luas_tanam) foreach ($des->luas_tanam as $lt) {
                        if ($lt->verified_at) $luas_tanam_harian[] = $lt;
                    }
                    if ($des->pompanisasi) foreach ($des->pompanisasi as $pom) if ($pom->verified_at) {
                        // dd($pom->pompa_ref_diterima->pompa_ref_dimanfaatkan);
                        if ($pom->pompa_ref_diterima) $pompanisasi->ref_diterima += $pom->pompa_ref_diterima->total_unit;
                        if ($pom->pompa_ref_diterima && $pom->pompa_ref_diterima->pompa_ref_dimanfaatkan) $pompanisasi->ref_dimanfaatkan += $pom->pompa_ref_diterima->pompa_ref_dimanfaatkan->total_unit;
                        if ($pom->pompa_abt_usulan) $pompanisasi->abt_usulan += $pom->pompa_abt_usulan->total_unit;
                        if ($pom->pompa_abt_usulan && $pom->pompa_abt_usulan->pompa_abt_diterima) $pompanisasi->abt_diterima += $pom->pompa_abt_usulan->pompa_abt_diterima->total_unit;
                        if ($pom->pompa_abt_usulan && $pom->pompa_abt_usulan->pompa_abt_diterima && $pom->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan) $pompanisasi->abt_dimanfaatkan += $pom->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan->total_unit;
                    }
                }
            }
        }
        
        // dd($pompanisasi);
        return view('kabupaten.dashboard', ['luas_tanam_harian' => $luas_tanam_harian, 'pompanisasi' => $pompanisasi]);
    }

    public function verifikasiDataView() {
        $user = Auth::user();
        $kecamatan = [];
        $pompanisasi = [];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            foreach ($kecamatan as $kec) foreach ($kec->desa as $des) if (!empty($des->luas_tanam) && !empty($des->pompanisasi)) {
                // $row_pom = (object) [];
                // // foreach ($des->luas_tanam as $lt) {
                // //     $row_pom->luas_tanam[] = $lt;
                // // }
                // $row_pom->luas_tanam = $des->luas_tanam;
                foreach ($des->pompanisasi as $pom) {
                    if (
                        $pom->pompa_ref_diterima 
                        && $pom->pompa_ref_diterima->pompa_ref_dimanfaatkan
                        && $pom->pompa_abt_usulan
                        && $pom->pompa_abt_usulan->pompa_abt_diterima
                        && $pom->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan
                    ) {
                        $status = $pom->verified_at;
                        foreach ($pom->desa->luas_tanam as $lt) {
                            if (!$lt->verified_at) $status = null;
                        }
                        $pom->luas_tanam = $pom->desa->luas_tanam;
                        $pom->status = $status;
                        $pompanisasi[] = $pom;
                    }
                }
            }
        }
        $pompanisasi = $this->paginate($pompanisasi, 10);
        // dd($pompanisasi);
        return view('kabupaten.verifikasiData', ['pompanisasi' => $pompanisasi]);
    }

    public function verifikasiData($des_id) {
        $id = Crypt::decryptString($des_id);
        $desa = Desa::find($id);
        // dd($desa);
        // foreach ($desa as $des) {
        //     dd($des);
            foreach ($desa->luas_tanam as $lt) {
                $lt->update(['verified_at' => now()]);
            }
            foreach ($desa->pompanisasi as $pom) {
                if (
                    $pom->pompa_ref_diterima
                    && $pom->pompa_ref_diterima->pompa_ref_dimanfaatkan
                    && $pom->pompa_abt_usulan
                    && $pom->pompa_abt_usulan->pompa_abt_diterima
                    && $pom->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan
                ) $pom->update(['verified_at' => now()]);
            }
        // }
        return back()->with('success', 'berhasil verifikasi data');
    }
}
