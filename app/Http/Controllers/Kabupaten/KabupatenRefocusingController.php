<?php

namespace App\Http\Controllers\Kabupaten;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\PompaRefDimanfaatkan;
use App\Models\PompaRefDiterima;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class KabupatenRefocusingController extends Controller
{
    use ArrayPaginator;

    public function diterimaView(Request $request) {
        $user = Auth::user();
        $kecamatan = [];
        $ref_diterima = [];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            $desa = [];
            foreach ($kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->kecamatan) $desa = Desa::where('kecamatan_id', $request->kecamatan)->distinct()->pluck('id');
            $ref_diterima = PompaRefDiterima::whereIn('desa_id', $desa);
            if ($request->tanggal) $ref_diterima = $ref_diterima->where('tanggal', $request->tanggal);
            $ref_diterima = $ref_diterima->where('verified_at', '!=', null)->paginate(10);
        }
        return view('kabupaten.refocusing.Diterima', ['kecamatan' => $kecamatan, 'ref_diterima' => $ref_diterima]);
    }

    public function detailDiterimaView($kec_id) {
        $kecamatan = Kecamatan::find(Crypt::decryptString($kec_id));
        $ref_diterima = [];
        foreach ($kecamatan->desa as $des) {
            foreach ($des->pompanisasi as $pom) {
                if ($pom->pompa_ref_diterima) $ref_diterima[] = $pom->pompa_ref_diterima;
            }
        }
        return view('kabupaten.refocusing.detail_refocusing_kecamatan_diterima', ['ref_diterima' => $ref_diterima, 'desa' => $kecamatan->desa]);
    }

    public function digunakanView(Request $request) {
        $user = Auth::user();
        $kecamatan = [];
        $ref_digunakan = [];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            $desa = [];
            foreach ($kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->kecamatan) $desa = Desa::where('kecamatan_id', $request->kecamatan)->distinct()->pluck('id');
            $ref_digunakan = PompaRefDimanfaatkan::whereIn('desa_id', $desa);
            if ($request->tanggal) $ref_digunakan = $ref_digunakan->where('tanggal', $request->tanggal);
            $ref_digunakan = $ref_digunakan->where('verified_at', '!=', null)->paginate(10);
        }
        return view('kabupaten.refocusing.Digunakan', ['kecamatan' => $kecamatan, 'ref_digunakan' => $ref_digunakan]);
    }

    public function detailDigunakanView($kec_id) {
        $kecamatan = Kecamatan::find(Crypt::decryptString($kec_id));
        $ref_dimanfaatkan = [];
        foreach ($kecamatan->desa as $des) {
            foreach ($des->pompanisasi as $pom) {
                if ($pom->pompa_ref_diterima && $pom->pompa_ref_diterima->pompa_ref_dimanfaatkan) $ref_dimanfaatkan[] = $pom->pompa_ref_diterima->pompa_ref_dimanfaatkan;
            }
        }
        return view('kabupaten.refocusing.detail_refocusing_kecamatan_digunakan', ['ref_dimanfaatkan' => $ref_dimanfaatkan, 'desa' => $kecamatan->desa]);
    }

    public function detailDigunakanDetail($id) {
        $ref_dimanfaatkan = PompaRefDimanfaatkan::find(Crypt::decryptString($id));
        return view('kabupaten.refocusing.detail_dimanfaatkan', ['ref_dimanfaatkan' => $ref_dimanfaatkan]);
    }
}
