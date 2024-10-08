<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KabupatenController extends Controller
{
    public function index(Request $request) {
        $provinsi = Provinsi::get();
        $kabupaten = Kabupaten::paginate(10);
        // dd($kabupaten[0]->provinsi->wilayah->nama);
        if ($request->nama) $kabupaten = Kabupaten::where('nama', 'LIKE', "%$request->nama%")->paginate(10);
        return view('admin.manageKabupaten', ['provinsi' => $provinsi, 'kabupaten' => $kabupaten]);
    }

    public function store(Request $request) {
        $request->validate([
            'provinsi_id' => 'required',
            'nama' => 'required',
        ], [
            'provinsi_id.required' => 'Provinsi tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
        ]);
        Kabupaten::create($request->except('_token'));
        return back()->with('success', 'berhasil menambah kabupaten');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'provinsi_id' => 'required',
            'nama' => 'required',
        ], [
            'provinsi_id.required' => 'Provinsi tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
        ]);
        Kabupaten::find(Crypt::decryptString($id))->update($request->except('_token'));
        return back()->with('success', 'berhasil mengubah kabupaten');
    }

    public function  destroy($id) {
        $kabupaten = Kabupaten::find(Crypt::decryptString($id));
        if (!$kabupaten) return back()->withErrors('kabupaten tidak ditemukan');
        if (count($kabupaten->kecamatan)) return back()->withErrors('kabupaten tidak dapat dihapus, terdapat kecamatan di kabupaten ini');
        $kabupaten->delete();
        return back()->with('success', 'berhasil menghapus kabupaten');
    }
}
