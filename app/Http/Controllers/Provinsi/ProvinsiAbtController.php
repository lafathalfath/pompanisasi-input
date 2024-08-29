<?php

namespace App\Http\Controllers\Provinsi;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
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
        $abt_usulan = [];
        $kabupaten = $user->provinsi ? $user->provinsi->kabupaten : [];
        if ($user->provinsi) {
            $desa = [];
            foreach ($kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->kabupaten) {
                $desa = [];
                foreach(Kabupaten::find($request->kabupaten)->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            }
            $abt_usulan = PompaAbtUsulan::whereIn('desa_id', $desa)->where('verified_at', '!=', null);
            if ($request->tanggal) $abt_usulan = $abt_usulan->where('tanggal', $request->tanggal);
            $abt_usulan = $abt_usulan->paginate(10);
        }
        return view('provinsi.abt.usulan', ['abt_usulan' => $abt_usulan, 'kabupaten' => $kabupaten]);
        // return view
    }

    public function diterima(Request $request) {
        $user = Auth::user();
        $kabupaten = $user->provinsi ? $user->provinsi->kabupaten : [];
        $abt_diterima = [];
        if ($user->provinsi) {
            $desa = [];
            foreach ($kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->kabupaten) {
                $desa = [];
                foreach(Kabupaten::find($request->kabupaten)->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            }
            $abt_diterima = PompaAbtDiterima::whereIn('desa_id', $desa)->where('verified_at', '!=', null);
            if ($request->tanggal) $abt_diterima = $abt_diterima->where('tanggal', $request->tanggal);
            $abt_diterima = $abt_diterima->paginate(10);
        }
        return view('provinsi.abt.diterima', ['abt_diterima' => $abt_diterima, 'kabupaten' => $kabupaten]);
    }

    public function detailDiterima($id) {
        $abt_diterima = PompaAbtDiterima::find(Crypt::decryptString($id));
        return view('provinsi.abt.detail_diterima', ['abt_diterima' => $abt_diterima]);
    }

    public function dimanfaatkan(Request $request) {
        $user = Auth::user();
        $kabupaten = $user->provinsi ? $user->provinsi->kabupaten : [];
        $abt_dimanfaatkan = [];
        if ($user->provinsi) {
            $desa = [];
            foreach ($kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->kabupaten) {
                $desa = [];
                foreach(Kabupaten::find($request->kabupaten)->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            }
            $abt_dimanfaatkan = PompaAbtDimanfaatkan::whereIn('desa_id', $desa)->where('verified_at', '!=', null);
            if ($request->tanggal) $abt_dimanfaatkan = $abt_dimanfaatkan->where('tanggal', $request->tanggal);
            $abt_dimanfaatkan = $abt_dimanfaatkan->paginate(10);
        }
        return view('provinsi.abt.digunakan', ['abt_dimanfaatkan' => $abt_dimanfaatkan, 'kabupaten' => $kabupaten]);
    }

    public function detailDimanfaatkan($id) {
        $abt_dimanfaatkan = PompaAbtDimanfaatkan::find(Crypt::decryptString($id));
        return view('provinsi.abt.detail_digunakan', ['abt_dimanfaatkan' => $abt_dimanfaatkan]);
    }
}
