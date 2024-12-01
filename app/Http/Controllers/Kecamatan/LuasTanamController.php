<?php

namespace App\Http\Controllers\Kecamatan;

use App\Http\Controllers\Controller;
use App\Models\LuasTanam;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LuasTanamController extends Controller
{
    use ArrayPaginator;

    public function index(Request $request) {
        $user = Auth::user();
        $desa = [];
        $desa_id = [];
        $luas_tanam = [];
        if ($user->kecamatan) {
            $desa = $user->kecamatan->desa;
            foreach ($user->kecamatan->desa as $des) {
                $desa_id[] = $des->id;
            };
            if ($request->desa) $desa_id = [$request->desa];
            $luas_tanam = LuasTanam::whereIn('desa_id', $desa_id);
            if ($request->tanggal) $luas_tanam = $luas_tanam->where('tanggal', $request->tanggal);
            $luas_tanam = $luas_tanam->get();
        }
        // dd($luas_tanam);
        $luas_tanam = $this->paginate($luas_tanam, 10);
        return view('kecamatan.luasTanamHarian', ['luas_tanam' => $luas_tanam, 'desa' => $desa]);
    }

    public function create() {
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
        $luas_tanam = LuasTanam::create([
            ...$request->except('_token'),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        if (!$luas_tanam) return back()->withErrors('Data gagal disimpan');
        return redirect()->route('luasTanamHarianKec')->with('success', 'Data berhasil disimpan');
    }
}
