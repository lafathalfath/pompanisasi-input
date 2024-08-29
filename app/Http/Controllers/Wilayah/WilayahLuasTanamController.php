<?php

namespace App\Http\Controllers\Wilayah;

use App\Http\Controllers\Controller;
use App\Models\LuasTanam;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WilayahLuasTanamController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $provinsi = $user->wilayah ? $user->wilayah->provinsi : [];
        $luas_tanam = [];
        if ($user->wilayah) {
            $desa = [];
            foreach ($user->wilayah->provinsi as $prov) foreach ($prov->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->provinsi) {
                $desa = [];
                foreach (Provinsi::find($request->provinsi)->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            }
            $luas_tanam = LuasTanam::whereIn('desa_id', $desa)->where('verified_at', '!=', null);
            if ($request->tanggal) $luas_tanam = $luas_tanam->where('tanggal', $request->tanggal);
            $luas_tanam = $luas_tanam->paginate(10);
        }
        return view('wilayah.luasTanamHarian', ['provinsi' => $provinsi, 'luas_tanam' => $luas_tanam]);
    }
}
