<?php

namespace App\Http\Controllers\Wilayah;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\LuasTanam;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WilayahLuasTanamController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $provinsi = $user->wilayah ? $user->wilayah->provinsi : [];
        $kabupaten = [];
        $kecamatan = [];
        $desa = [];
        $luas_tanam = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $desa_id = [];
            foreach ($provinsi as $prov) foreach ($prov->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
            $luas_tanam = LuasTanam::where('verified_at', '!=', null);
            if ($request->provinsi) {
                $kabupaten = Kabupaten::where('provinsi_id', $request->provinsi)->get();
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
                } else {
                    $desa_id = [];
                    foreach (Provinsi::find($request->provinsi)->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
                }
            }
            $luas_tanam = $luas_tanam->whereIn('desa_id', $desa_id);
            if ($request->tanggal) $luas_tanam = $luas_tanam->where('tanggal', $request->tanggal);
            $luas_tanam = $luas_tanam->paginate(10);
        }
        return view('wilayah.luasTanamHarian', ['luas_tanam' => $luas_tanam, 'provinsi' => $provinsi, 'kabupaten' => $kabupaten, 'kecamatan' => $kecamatan, 'desa' => $desa]);
    }
}
