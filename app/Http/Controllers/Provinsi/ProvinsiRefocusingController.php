<?php

namespace App\Http\Controllers\Provinsi;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\PompaRefDimanfaatkan;
use App\Models\PompaRefDiterima;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ProvinsiRefocusingController extends Controller
{
    use ArrayPaginator;

    public function diterima(Request $request) {
        $user = Auth::user();
        $ref_diterima = [];
        // if ($request->kabupaten) dd(Kabupaten::find($request->kabupaten)->kecamatan);
        $kabupaten = $user->provinsi ? $user->provinsi->kabupaten : [];
        if ($user->provinsi) {
            $desa = [];
            foreach ($kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->kabupaten) {
                $desa = [];
                foreach(Kabupaten::find($request->kabupaten)->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            }
            $ref_diterima = PompaRefDiterima::whereIn('desa_id', $desa)->where('verified_at', '!=', null);
            if ($request->tanggal) $ref_diterima = $ref_diterima->where('tanggal', $request->tanggal);
            $ref_diterima = $ref_diterima->paginate(10);
        }
        return view('provinsi.refocusing.diterima', ['ref_diterima' => $ref_diterima, 'kabupaten' => $kabupaten]);
    }

    public function detailDiterima($id) {
        $ref_diterima = PompaRefDiterima::find(Crypt::decryptString($id));
        return view('provinsi.refocusing.detail_diterima', ['ref_diterima' => $ref_diterima]);
    }

    public function dimanfaatkan(Request $request) {
        $user = Auth::user();
        $kabupaten = $user->provinsi ? $user->provinsi->kabupaten : [];
        $ref_dimanfaatkan = [];
        if ($user->provinsi) {
        $desa = [];
        foreach ($kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
        if ($request->kabupaten) {
            $desa = [];
            foreach(Kabupaten::find($request->kabupaten)->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
        }
        $ref_dimanfaatkan = PompaRefDimanfaatkan::whereIn('desa_id', $desa)->where('verified_at', '!=', null);
        if ($request->tanggal) $ref_dimanfaatkan = $ref_dimanfaatkan->where('tanggal', $request->tanggal);
        $ref_dimanfaatkan = $ref_dimanfaatkan->paginate(10);
        }
        return view('provinsi.refocusing.digunakan', ['ref_dimanfaatkan' =>$ref_dimanfaatkan, 'kabupaten' => $kabupaten]);
    }

    public function detailDimanfaatkan($id) {
        $ref_dimanfaatkan = PompaRefDimanfaatkan::find(Crypt::decryptString($id));
        return view('provinsi.refocusing.detail_digunakan', ['ref_dimanfaatkan' => $ref_dimanfaatkan]);
    }
}
