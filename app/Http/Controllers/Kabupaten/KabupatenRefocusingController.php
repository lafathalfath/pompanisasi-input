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
        $kecamatan = $user->kabupaten ? $user->kabupaten->kecamatan : [];
        $desa = [];
        $ref_diterima = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $desa_id = [];
            foreach ($kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
            $ref_diterima = PompaRefDiterima::where('verified_at', '!=', null);
            if ($request->kecamatan) {
                $desa = Desa::where('kecamatan_id', $request->kecamatan)->get();
                if ($request->desa) {
                    $desa_id = [$request->desa];
                } else {
                    $desa_id = [];
                    foreach (Kecamatan::find($request->kecamatan)->desa as $des) $desa_id[] = $des->id;
                }
            }
            $ref_diterima = $ref_diterima->whereIn('desa_id', $desa_id);
            if ($request->tanggal) $ref_diterima = $ref_diterima->where('tanggal', $request->tanggal);
            $ref_diterima = $ref_diterima->paginate(10);
        }
        return view('kabupaten.refocusing.diterima', ['ref_diterima' => $ref_diterima, 'kecamatan' => $kecamatan, 'desa' => $desa]);
    }

    public function detailDiterimaView($id) {
        $ref_diterima = PompaRefDiterima::find(Crypt::decryptString($id));
        return view('kabupaten.refocusing.detail_diterima', ['ref_diterima' => $ref_diterima]);
    }

    public function digunakanView(Request $request) {
        $user = Auth::user();
        $kecamatan = $user->kabupaten ? $user->kabupaten->kecamatan : [];
        $desa = [];
        $ref_dimanfaatkan = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $desa_id = [];
            foreach ($kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
            $ref_dimanfaatkan = PompaRefDimanfaatkan::where('verified_at', '!=', null);
            if ($request->kecamatan) {
                $desa = Desa::where('kecamatan_id', $request->kecamatan)->get();
                if ($request->desa) {
                    $desa_id = [$request->desa];
                } else {
                    $desa_id = [];
                    foreach (Kecamatan::find($request->kecamatan)->desa as $des) $desa_id[] = $des->id;
                }
            }
            $ref_dimanfaatkan = $ref_dimanfaatkan->whereIn('desa_id', $desa_id);
            if ($request->tanggal) $ref_dimanfaatkan = $ref_dimanfaatkan->where('tanggal', $request->tanggal);
            $ref_dimanfaatkan = $ref_dimanfaatkan->paginate(10);
        }
        return view('kabupaten.refocusing.digunakan', ['ref_dimanfaatkan' => $ref_dimanfaatkan, 'kecamatan' => $kecamatan, 'desa' => $desa]);
    }

    public function detailDigunakanView($id) {
        $ref_dimanfaatkan = PompaRefDimanfaatkan::find(Crypt::decryptString($id));
        return view('kabupaten.refocusing.detail_dimanfaatkan', ['ref_dimanfaatkan' => $ref_dimanfaatkan]);
    }
}
