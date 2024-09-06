<?php

namespace App\Http\Controllers\Kabupaten;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\PompaAbtDimanfaatkan;
use App\Models\PompaAbtDiterima;
use App\Models\PompaAbtUsulan;
use App\Models\Pompanisasi;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class KabupatenAbtController extends Controller
{
    use ArrayPaginator;

    public function usulanView(Request $request) {
        $user = Auth::user();
        $kecamatan = $user->kabupaten ? $user->kabupaten->kecamatan : [];
        $desa = [];
        $abt_usulan = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $desa_id = [];
            foreach ($kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
            $abt_usulan = PompaAbtUsulan::where('verified_at', '!=', null);
            if ($request->kecamatan) {
                $desa = Desa::where('kecamatan_id', $request->kecamatan)->get();
                if ($request->desa) {
                    $desa_id = [$request->desa];
                } else {
                    $desa_id = [];
                    foreach (Kecamatan::find($request->kecamatan)->desa as $des) $desa_id[] = $des->id;
                }
            }
            $abt_usulan = $abt_usulan->whereIn('desa_id', $desa_id);
            if ($request->tanggal) $abt_usulan = $abt_usulan->where('tanggal', $request->tanggal);
            $abt_usulan = $abt_usulan->paginate(10);
        }
        return view('kabupaten.abt.usulan', ['abt_usulan' => $abt_usulan, 'kecamatan' => $kecamatan, 'desa' => $desa]);
    }

    public function diterimaView(Request $request) {
        $user = Auth::user();
        $kecamatan = $user->kabupaten ? $user->kabupaten->kecamatan : [];
        $desa = [];
        $abt_diterima = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $desa_id = [];
            foreach ($kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
            $abt_diterima = PompaAbtDiterima::where('verified_at', '!=', null);
            if ($request->kecamatan) {
                $desa = Desa::where('kecamatan_id', $request->kecamatan)->get();
                if ($request->desa) {
                    $desa_id = [$request->desa];
                } else {
                    $desa_id = [];
                    foreach (Kecamatan::find($request->kecamatan)->desa as $des) $desa_id[] = $des->id;
                }
            }
            $abt_diterima = $abt_diterima->whereIn('desa_id', $desa_id);
            if ($request->tanggal) $abt_diterima = $abt_diterima->where('tanggal', $request->tanggal);
            $abt_diterima = $abt_diterima->paginate(10);
        }
        return view('kabupaten.abt.diterima', ['abt_diterima' => $abt_diterima, 'kecamatan' => $kecamatan, 'desa' => $desa]);
    }

    public function detailDiterimaView($id) {
        $abt_diterima = PompaAbtDiterima::find(Crypt::decryptString($id));
        return view('kabupaten.abt.detail_diterima', ['abt_diterima' => $abt_diterima]);
    }

    public function digunakanView(Request $request) {
        $user = Auth::user();
        $kecamatan = $user->kabupaten ? $user->kabupaten->kecamatan : [];
        $desa = [];
        $abt_dimanfaatkan = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $desa_id = [];
            foreach ($kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
            $abt_dimanfaatkan = PompaAbtDimanfaatkan::where('verified_at', '!=', null);
            if ($request->kecamatan) {
                $desa = Desa::where('kecamatan_id', $request->kecamatan)->get();
                if ($request->desa) {
                    $desa_id = [$request->desa];
                } else {
                    $desa_id = [];
                    foreach (Kecamatan::find($request->kecamatan)->desa as $des) $desa_id[] = $des->id;
                }
            }
            $abt_dimanfaatkan = $abt_dimanfaatkan->whereIn('desa_id', $desa_id);
            if ($request->tanggal) $abt_dimanfaatkan = $abt_dimanfaatkan->where('tanggal', $request->tanggal);
            $abt_dimanfaatkan = $abt_dimanfaatkan->paginate(10);
        }
        return view('kabupaten.abt.digunakan', ['abt_dimanfaatkan' => $abt_dimanfaatkan, 'kecamatan' => $kecamatan, 'desa' => $desa]);
    }

    public function detailDigunakanView($id) {
        $abt_dimanfaatkan = PompaAbtDimanfaatkan::find(Crypt::decryptString($id));
        return view('kabupaten.abt.detail_dimanfaatkan', ['abt_dimanfaatkan' => $abt_dimanfaatkan]);
    }
}
