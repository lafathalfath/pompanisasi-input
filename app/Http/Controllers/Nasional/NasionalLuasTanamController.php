<?php

namespace App\Http\Controllers\Nasional;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\LuasTanam;
use App\Models\Provinsi;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NasionalLuasTanamController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $wilayah = Wilayah::get();
        $provinsi = [];
        $kabupaten = [];
        $kecamatan = [];
        $desa = [];
        $luas_tanam = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $desa_id = [];
            $luas_tanam = LuasTanam::where('verified_at', '!=', null);
            if ($request->wilayah) {
                $provinsi = Provinsi::where('wilayah_id', $request->wilayah)->get();
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
                } else {
                    $desa_id = [];
                    foreach (Wilayah::find($request->wilayah)->provinsi as $prov) foreach ($prov->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
                }
                $luas_tanam = $luas_tanam->whereIn('desa_id', $desa_id);
            }
            if ($request->tanggal) $luas_tanam = $luas_tanam->where('tanggal', $request->tanggal);
            $luas_tanam = $luas_tanam->paginate(10);
        }
        return view('nasional.luasTanamHarian', ['luas_tanam' => $luas_tanam, 'wilayah' => $wilayah, 'provinsi' => $provinsi, 'kabupaten' => $kabupaten, 'kecamatan' => $kecamatan, 'desa' => $desa]);
    }
}
