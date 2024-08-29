<?php

namespace App\Http\Controllers\Provinsi;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\LuasTanam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvinsiLuasTanamController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $kabupaten = $user->provinsi ? $user->provinsi->kabupaten : [];
        $luas_tanam = [];
        if ($user->provinsi) {
            $desa = [];
            foreach ($kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            if ($request->kabupaten) {
                $desa = [];
                foreach (Kabupaten::find($request->kabupaten)->kecamatan as $kec) foreach ($kec->desa as $des) $desa[] = $des->id;
            }
            $luas_tanam = LuasTanam::whereIn('desa_id', $desa)->where('verified_at', '!=', null);
            if ($request->tanggal) $luas_tanam = $luas_tanam->where('tanggal', $request->tanggal);
            $luas_tanam = $luas_tanam->paginate(10);
        }
        return view('provinsi.luasTanamHarian', ['luas_tanam' => $luas_tanam, 'kabupaten' => $kabupaten]);
    }
}
