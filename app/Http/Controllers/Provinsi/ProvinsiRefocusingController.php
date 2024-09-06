<?php

namespace App\Http\Controllers\Provinsi;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
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
        $kabupaten = $user->provinsi ? $user->provinsi->kabupaten : [];
        $kecamatan = [];
        $desa = [];
        $ref_diterima = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $desa_id = [];
            foreach ($kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
            $ref_diterima = PompaRefDiterima::where('verified_at', '!=', null);
            if ($request->kabupaten) {
                $kecamatan = Kecamatan::where('kabupaten_id', $request->kabupaten)->get();
                if ($request->kecamatan) {
                    $desa = Desa::where('kecamatan_id', $request->kecamatan)->get();
                    if ($request->desa) {
                        $desa_id = [$request->desa];
                    } else {
                        $desa_id = [];
                        foreach (Kecamatan::find($request->kecamatan)->desa as $des) $desa_id[] = $des->id;
                    }
                } else {
                    $desa_id = [];
                    foreach (Kabupaten::find($request->kabupaten)->kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
                }
            }
            $ref_diterima = $ref_diterima->whereIn('desa_id', $desa_id);
            if ($request->tanggal) $ref_diterima = $ref_diterima->where('tanggal', $request->tanggal);
            $ref_diterima = $ref_diterima->paginate(10);
        }
        return view('provinsi.refocusing.diterima', ['ref_diterima' => $ref_diterima, 'kabupaten' => $kabupaten, 'kecamatan' => $kecamatan, 'desa' => $desa]);
    }

    public function detailDiterima($id) {
        $ref_diterima = PompaRefDiterima::find(Crypt::decryptString($id));
        return view('provinsi.refocusing.detail_diterima', ['ref_diterima' => $ref_diterima]);
    }

    public function dimanfaatkan(Request $request) {
        $user = Auth::user();
        $kabupaten = $user->provinsi ? $user->provinsi->kabupaten : [];
        $kecamatan = [];
        $desa = [];
        $ref_dimanfaatkan = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $desa_id = [];
            foreach ($kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
            $ref_dimanfaatkan = PompaRefDimanfaatkan::where('verified_at', '!=', null);
            if ($request->kabupaten) {
                $kecamatan = Kecamatan::where('kabupaten_id', $request->kabupaten)->get();
                if ($request->kecamatan) {
                    $desa = Desa::where('kecamatan_id', $request->kecamatan)->get();
                    if ($request->desa) {
                        $desa_id = [$request->desa];
                    } else {
                        $desa_id = [];
                        foreach (Kecamatan::find($request->kecamatan)->desa as $des) $desa_id[] = $des->id;
                    }
                } else {
                    $desa_id = [];
                    foreach (Kabupaten::find($request->kabupaten)->kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
                }
            }
            $ref_dimanfaatkan = $ref_dimanfaatkan->whereIn('desa_id', $desa_id);
            if ($request->tanggal) $ref_dimanfaatkan = $ref_dimanfaatkan->where('tanggal', $request->tanggal);
            $ref_dimanfaatkan = $ref_dimanfaatkan->paginate(10);
        }
        return view('provinsi.refocusing.digunakan', ['ref_dimanfaatkan' => $ref_dimanfaatkan, 'kabupaten' => $kabupaten, 'kecamatan' => $kecamatan, 'desa' => $desa]);
    }

    public function detailDimanfaatkan($id) {
        $ref_dimanfaatkan = PompaRefDimanfaatkan::find(Crypt::decryptString($id));
        return view('provinsi.refocusing.detail_digunakan', ['ref_dimanfaatkan' => $ref_dimanfaatkan]);
    }
}
