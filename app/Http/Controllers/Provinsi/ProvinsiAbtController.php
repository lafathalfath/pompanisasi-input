<?php

namespace App\Http\Controllers\Provinsi;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\PompaAbtDimanfaatkan;
use App\Models\PompaAbtDiterima;
use App\Models\PompaAbtUsulan;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ProvinsiAbtController extends Controller
{
    use ArrayPaginator;

    public function usulan(Request $request) {
        $user = Auth::user();
        $kabupaten = $user->provinsi ? $user->provinsi->kabupaten : [];
        $kecamatan = [];
        $desa = [];
        $abt_usulan = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $desa_id = [];
            $abt_usulan = PompaAbtUsulan::where('verified_at', '!=', null);
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
                $abt_usulan = $abt_usulan->whereIn('desa_id', $desa_id);
            }
            if ($request->tanggal) $abt_usulan = $abt_usulan->where('tanggal', $request->tanggal);
            $abt_usulan = $abt_usulan->paginate(10);
        }
        return view('provinsi.abt.usulan', ['abt_usulan' => $abt_usulan, 'kabupaten' => $kabupaten, 'kecamatan' => $kecamatan, 'desa' => $desa]);
    }

    public function diterima(Request $request) {
        $user = Auth::user();
        $kabupaten = $user->provinsi ? $user->provinsi->kabupaten : [];
        $kecamatan = [];
        $desa = [];
        $abt_diterima = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $desa_id = [];
            $abt_diterima = PompaAbtDiterima::where('verified_at', '!=', null);
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
                $abt_diterima = $abt_diterima->whereIn('desa_id', $desa_id);
            }
            if ($request->tanggal) $abt_diterima = $abt_diterima->where('tanggal', $request->tanggal);
            $abt_diterima = $abt_diterima->paginate(10);
        }
        return view('provinsi.abt.diterima', ['abt_diterima' => $abt_diterima, 'kabupaten' => $kabupaten, 'kecamatan' => $kecamatan, 'desa' => $desa]);
    }

    public function detailDiterima($id) {
        $abt_diterima = PompaAbtDiterima::find(Crypt::decryptString($id));
        return view('provinsi.abt.detail_diterima', ['abt_diterima' => $abt_diterima]);
    }

    public function dimanfaatkan(Request $request) {
        $user = Auth::user();
        $kabupaten = $user->provinsi ? $user->provinsi->kabupaten : [];
        $kecamatan = [];
        $desa = [];
        $abt_dimanfaatkan = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $desa_id = [];
            $abt_dimanfaatkan = PompaAbtDimanfaatkan::where('verified_at', '!=', null);
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
                $abt_dimanfaatkan = $abt_dimanfaatkan->whereIn('desa_id', $desa_id);
            }
            if ($request->tanggal) $abt_dimanfaatkan = $abt_dimanfaatkan->where('tanggal', $request->tanggal);
            $abt_dimanfaatkan = $abt_dimanfaatkan->paginate(10);
        }
        return view('provinsi.abt.digunakan', ['abt_dimanfaatkan' => $abt_dimanfaatkan, 'kabupaten' => $kabupaten, 'kecamatan' => $kecamatan, 'desa' => $desa]);
    }

    public function detailDimanfaatkan($id) {
        $abt_dimanfaatkan = PompaAbtDimanfaatkan::find(Crypt::decryptString($id));
        return view('provinsi.abt.detail_digunakan', ['abt_dimanfaatkan' => $abt_dimanfaatkan]);
    }
}
