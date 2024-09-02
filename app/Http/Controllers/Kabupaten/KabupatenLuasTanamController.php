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
        $desa = [];
        $luas_tanam = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $desa_id = [];
            $luas_tanam = LuasTanam::where('verified_at', '!=', null);
            if ($request->kecamatan) {
                $desa = Desa::where('kecamatan_id', $request->kecamatan)->get();
                if ($request->desa) {
                    $desa_id = [$request->desa];
                } else {
                    $desa_id = [];
                    foreach (Kecamatan::find($request->kecamatan)->desa as $des) $desa_id[] = $des->id;
                }
                $luas_tanam = $luas_tanam->whereIn('desa_id', $desa_id);
            }
            if ($request->tanggal) $luas_tanam = $luas_tanam->where('tanggal', $request->tanggal);
            $luas_tanam = $luas_tanam->paginate(10);
        }
        return view('kabupaten.luasTanamHarian', ['luas_tanam' => $luas_tanam, 'kecamatan' => $kecamatan, 'desa' => $desa]);
    }
}
