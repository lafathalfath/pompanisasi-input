<?php

namespace App\Http\Controllers\Kecamatan;

use App\Http\Controllers\Controller;
use App\Models\LuasTanam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LuasTanamController extends Controller
{
    public function index() {
        $user = Auth::user();
        $desa = $user->kecamatan ? $user->kecamatan->desa : [];
        return view('kecamatan.inputLuasTanam', ['desa' => $desa]);
    }

    public function store(Request $request) {
        $request->validate([
            'desa_id' => 'required',
            'nama_poktan' => 'required',
            'luas_tanam' => 'required',
            'tanggal' => 'required',
        ]);
        $luas_tanam = LuasTanam::create($request->except(['_token',]));
        if (!$luas_tanam) return back()->withErrors('Data gagal disimpan');
        return redirect()->route('kecamatan.dashboard')->with('success', 'Data berhasil disimpan');
    }
}
