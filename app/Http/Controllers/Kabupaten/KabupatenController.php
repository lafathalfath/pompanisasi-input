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
        $kecamatan = $user->kabupaten ? $user->kabupaten->kecamatan : [];
        $all_pompanisasi = [];
        $pompanisasi = [];
        if (!empty($kecamatan)) foreach ($kecamatan as $kec) {
            $poktan = 0;
            $luas_tanam = 0;
            $ref_diterima = 0;
            $ref_dimanfaatkan = 0;
            $abt_usulan = 0;
            $abt_diterima = 0;
            $abt_dimanfaatkan = 0;
            $status = true;
            foreach ($kec->desa as $des) {
                foreach ($des->luas_tanam  as $lt) {
                    if (!$lt->verified_at) $status = false;
                    $luas_tanam += $lt->luas_tanam;
                }
                foreach ($des->pompanisasi as $pom) {
                    if (!$pom->verified_at) $status = false;
                    if (
                        $pom->pompa_ref_diterima
                        && $pom->pompa_ref_diterima->pompa_ref_dimanfaatkan
                        && $pom->pompa_abt_usulan
                        && $pom->pompa_abt_usulan->pompa_abt_diterima
                        && $pom->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan
                    ) {
                        $poktan += 3;
                        $ref_diterima += $pom->pompa_ref_diterima->total_unit;
                        $ref_dimanfaatkan += $pom->pompa_ref_diterima->pompa_ref_dimanfaatkan->total_unit;
                        $abt_usulan += $pom->pompa_abt_usulan->total_unit;
                        $abt_diterima += $pom->pompa_abt_usulan->pompa_abt_diterima->total_unit;
                        $abt_dimanfaatkan += $pom->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan->total_unit;
                    }
                }
            }
            if (
                $luas_tanam
                && $ref_diterima
                && $ref_dimanfaatkan
                && $abt_usulan
                && $abt_diterima
                && $abt_dimanfaatkan
            ) $pompanisasi[] = (object) [
                'kecamatan' => $kec,
                'poktan' => $poktan,
                'luas_tanam' => $luas_tanam,
                'ref_diterima' => $ref_diterima,
                'ref_dimanfaatkan' => $ref_dimanfaatkan,
                'abt_usulan' => $abt_usulan,
                'abt_diterima' => $abt_diterima,
                'abt_dimanfaatkan' => $abt_dimanfaatkan,
                'status' => $status,
            ];
        }
        $pompanisasi = $this->paginate($pompanisasi, 10);
        // dd($pompanisasi);
        return view('kabupaten.verifikasiData', ['pompanisasi' => $pompanisasi]);
    }

    public function verifikasiData($kec_id) {
        $id = Crypt::decryptString($kec_id);
        $kecamatan = Kecamatan::find($id);
        $desa = $kecamatan->desa;
        foreach ($desa as $des) {
            foreach ($des->luas_tanam as $lt) {
                $lt->update(['verified_at' => now()]);
            }
            foreach ($des->pompanisasi as $pom) {
                if (
                    $pom->pompa_ref_diterima
                    && $pom->pompa_ref_diterima->pompa_ref_dimanfaatkan
                    && $pom->pompa_abt_usulan
                    && $pom->pompa_abt_usulan->pompa_abt_diterima
                    && $pom->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan
                ) $pom->update(['verified_at' => now()]);
            }
        }
        return back()->with('success', 'berhasil verifikasi data');
    }
}
