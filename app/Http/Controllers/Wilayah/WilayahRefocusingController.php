<?php

namespace App\Http\Controllers\Wilayah;

use App\Http\Controllers\Controller;
use App\Models\PompaRefDimanfaatkan;
use App\Models\PompaRefDiterima;
use App\Models\Provinsi;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class WilayahRefocusingController extends Controller
{
    use ArrayPaginator;

    public function diterima(Request $request) {
        $user = Auth::user();
        $provinsi = $user->wilayah ? $user->wilayah->provinsi : [];
        $ref_diterima = [];
        if ($user->wilayah) {
            $desa = [];
            foreach ($provinsi as $prov) foreach ($prov->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->provinsi) {
                $desa = [];
                foreach (Provinsi::find($request->provinsi)->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            }
            $ref_diterima = PompaRefDiterima::whereIn('desa_id', $desa)->where('verified_at', '!=', null);
            if ($request->tanggal) $ref_diterima = $ref_diterima->where('tanggal', $request->tanggal);
            $ref_diterima = $ref_diterima->paginate(10);
        }
        return view('wilayah.refocusing.diterima', ['provinsi' => $provinsi, 'ref_diterima' => $ref_diterima]);
    }

    public function detailDiterima($id) {
        $ref_diterima = PompaRefDiterima::find(Crypt::decryptString($id));
        return view('wilayah.refocusing.detail_diterima', ['ref_diterima' => $ref_diterima]);
    }

    public function dimanfaatkan(Request $request) {
        $user = Auth::user();
        $provinsi = $user->wilayah ? $user->wilayah->provinsi : [];
        $ref_dimanfaatkan = [];
        if ($user->wilayah) {
            $desa = [];
            foreach ($provinsi as $prov) foreach ($prov->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->provinsi) {
                $desa = [];
                foreach (Provinsi::find($request->provinsi)->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            }
            $ref_dimanfaatkan = PompaRefDimanfaatkan::whereIn('desa_id', $desa)->where('verified_at', '!=', null);
            if ($request->tanggal) $ref_dimanfaatkan = $ref_dimanfaatkan->where('tanggal', $request->tanggal);
            $ref_dimanfaatkan = $ref_dimanfaatkan->paginate(10);
        }
        return view('wilayah.refocusing.digunakan', ['provinsi' => $provinsi, 'ref_dimanfaatkan' => $ref_dimanfaatkan]);
    }

    public function detailDimanfaatkan($id) {
        $ref_dimanfaatkan = PompaRefDimanfaatkan::find(Crypt::decryptString($id));
        return view('wilayah.refocusing.detail_digunakan', ['ref_dimanfaatkan' => $ref_dimanfaatkan]);
    }
}
