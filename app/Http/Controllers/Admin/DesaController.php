<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DesaController extends Controller
{
    public function index(Request $request) {
        $kecamatan = Kecamatan::get();
        $desa = Desa::paginate(10);
        if ($request->nama) $desa = Desa::where('nama', 'LIKE', "%$request->nama%")->paginate(10);
        return view('admin.manageDesa', ['desa' => $desa, 'kecamatan' => $kecamatan]);
    }

    public function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'kecamatan_id' => 'required',
            'nama' => 'required',
        ], [
            'kecamatan_id.required' => 'Kecamatan tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
        ]);
        // dd($request->all());
        Desa::create($request->except('_token'));
        return back()->with('success', 'berhasil menambah provinsi');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'kecamatan_id' => 'required',
            'nama' => 'required',
        ], [
            'kecamatan_id.required' => 'Kecamatan tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
        ]);
        Desa::find($id)->update($request->except('_token'));
        return back()->with('success', 'berhasil mengubah provinsi');
    }

    public function  destroy($id) {
        $desa = Desa::find(Crypt::decryptString($id));
        if (!$desa) return back()->withErrors('desa tidak ditemukan');
        if (
            count($desa->pompa_ref_diterima)
            || count($desa->pompa_ref_dimanfaatkan)
            || count($desa->pompa_abt_usulan)
            || count($desa->pompa_abt_diterima)
            || count($desa->pompa_abt_dimanfaatkan)
            || count($desa->luas_tanam)
        ) return back()->withErrors('desa tidak dapat dihapus, terdapat data pompa atau luas tanam harian');
        $desa->delete();
        return back()->with('success', 'berhasil menghapus desa');
    }
}
