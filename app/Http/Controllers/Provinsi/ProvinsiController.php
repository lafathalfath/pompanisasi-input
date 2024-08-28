<?php

namespace App\Http\Controllers\Provinsi;

use App\Http\Controllers\Controller;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvinsiController extends Controller
{
    use ArrayPaginator;

    public function index() {
        return view('provinsi.dashboard');
    }

    public function refDiterima() {
        $user = Auth::user();
        $kabupaten = [];
        $ref_diterima = [];
        if ($user->provinsi) {
            $kabupaten = $user->provinsi->kabupaten;
            foreach ($kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_ref_diterima as $rdt) if (
                $rdt->verified_at) {
                $ref_diterima[] = $rdt;
            }
        }
        $ref_diterima = $this->paginate($ref_diterima, 10);
        return view('provinsi.refocusing.diterima', ['kabupaten' => $kabupaten, 'ref_diterima' => $ref_diterima]);
    }
}
