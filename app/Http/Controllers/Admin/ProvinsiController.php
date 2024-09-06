<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProvinsiController extends Controller
{
    public function index(Request $request) {
        $wilayah = Wilayah::get();
        $provinsi = Provinsi::paginate(10);
        if ($request->nama) $provinsi = Provinsi::where('nama', 'LIKE', "%$request->nama%")->paginate(10);
        return view('admin.manageProvinsi', ['wilayah' => $wilayah, 'provinsi' => $provinsi]);
    }

    public function store(Request $request) {
        $request->validate([
            'wilayah_id' => 'required',
            'nama' => 'required',
        ], [
            'wilayah_id.required' => 'Wilayah tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
        ]);
        Provinsi::create($request->except('_token'));
        return back()->with('success', 'berhasil menambah provinsi');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'wilayah_id' => 'required',
            'nama' => 'required',
        ], [
            'wilayah_id.required' => 'Wilayah tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
        ]);
        Provinsi::find(Crypt::decryptString($id))->update($request->except('_token'));
        return back()->with('success', 'berhasil mengubah provinsi');
    }

    public function destroy($id) {
        $provinsi = Provinsi::find(Crypt::decryptString($id));
        if (!$provinsi) return back()->withErrors('provinsi tidak ditemukan');
        if (count($provinsi->kabupaten)) return back()->withErrors('provinsi tidak dapat dihapus, terdapat kabupaten di provinsi ini');
        $provinsi->delete();
        return back()->with('success', 'berhasil menghapus provinsi');
    }
}
