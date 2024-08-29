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

    public function detailDiterimaView($id) {
        $ref_diterima = PompaRefDiterima::find(Crypt::decryptString($id));
        return view('kabupaten.refocusing.detail_diterima', ['ref_diterima' => $ref_diterima]);
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

    public function detailDigunakanView($id) {
        $ref_dimanfaatkan = PompaRefDimanfaatkan::find(Crypt::decryptString($id));
        return view('kabupaten.refocusing.detail_dimanfaatkan', ['ref_dimanfaatkan' => $ref_dimanfaatkan]);
    }
}
