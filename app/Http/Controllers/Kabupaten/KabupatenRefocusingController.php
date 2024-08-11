<?php

namespace App\Http\Controllers\Kabupaten;

use App\Http\Controllers\Controller;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class KabupatenRefocusingController extends Controller
{
    use ArrayPaginator;

    public function diterimaView() {
        $user = Auth::user();
        $kecamatan = [];
        // kecamatan, jum_poktan, luas_lahan, diterima
        $ref_diterima = [];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            foreach ($kecamatan as $kec) {
                $poktan = 0;
                $luas_lahan = 0;
                $diterima = 0;
                foreach ($kec->desa as $des) {
                    if ($des->pompanisasi) foreach ($des->pompanisasi as $pom) {
                        if ($pom->pompa_ref_diterima) {
                            $diterima += $pom->pompa_ref_diterima->total_unit;
                            
                        }
                    }
                }
                if ($diterima > 0) $ref_diterima[] = (object) [
                    'kecamatan' => $kec,
                    'poktan' => $poktan,
                    'luas_lahan' => $luas_lahan,
                    'diterima' => $diterima,
                ];
            }
        }
        // dd($ref_diterima);
        return view('kabupaten.refocusing.Diterima', ['kecamatan' => $kecamatan, 'ref_diterima' => $ref_diterima]);
    }

    public function digunakanView() {
        $user = Auth::user();
        $kecamatan = [];
        $ref_digunakan = [];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            foreach ($kecamatan as $kec) {
                $poktan = 0;
                $luas_lahan = 0;
                $digunakan = 0;
                foreach ($kec->desa as $des) {
                    if ($des->pompanisasi) foreach ($des->pompanisasi as $pom) {
                        if ($pom->pompa_ref_diterima && $pom->pompa_ref_diterima->pompa_ref_dimanfaatkan) {
                            $poktan += 1;
                            $luas_lahan += $pom->pompa_ref_diterima->pompa_ref_dimanfaatkan->luas_lahan;
                            $digunakan += $pom->pompa_ref_diterima->pompa_ref_dimanfaatkan->total_unit;
                        }
                    }
                }
                if ($digunakan > 0) $ref_digunakan[] = (object) [
                    'kecamatan' => $kec,
                    'poktan' => $poktan,
                    'luas_lahan' => $luas_lahan,
                    'digunakan' => $digunakan,
                ];
            }
        }
        $ref_digunakan = $this->paginate($ref_digunakan, 10);
        // dd($ref_digunakan);
        return view('kabupaten.refocusing.Digunakan', ['kecamatan' => $kecamatan, 'ref_digunakan' => $ref_digunakan]);
    }
}
