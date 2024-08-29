<?php

namespace App\Http\Controllers\Kabupaten;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\LuasTanam;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KabupatenLuasTanamController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $kecamatan = $user->kabupaten ? $user->kabupaten->kecamatan : [];
        $luas_tanam = [];
        if ($user->kabupaten) {
            $desa_id = [];
            foreach ($user->kabupaten->kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
            if ($request->kecamatan) $desa_id = Desa::where('kecamatan_id', $request->kecamatan)->distinct()->pluck('id');
            $luas_tanam = LuasTanam::whereIn('desa_id', $desa_id);
            if ($request->tanggal) $luas_tanam = $luas_tanam->where('tanggal', $request->tanggal);
            $luas_tanam = $luas_tanam->where('verified_at', '!=', null)->paginate(10);
        }
        return view('kabupaten.luasTanamHarian', ['luas_tanam' => $luas_tanam, 'kecamatan' => $kecamatan]);
    }
}
