<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index(Request $request) {
        $kabupaten = Kabupaten::get();
        $kecamatan = Kecamatan::paginate(10);
        // dd($kabupaten[0]->provinsi->wilayah->nama);
        if ($request->nama) $kecamatan = Kecamatan::where('nama', 'LIKE', "%$request->nama%")->paginate(10);
        return view('admin.manageKecamatan', ['kabupaten' => $kabupaten, 'kecamatan' => $kecamatan]);
    }

    public function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'kabupaten_id' => 'required',
            'nama' => 'required',
        ], [
            'kabupaten_id.required' => 'Kabupaten tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
        ]);
        // dd($request->all());
        Kecamatan::create($request->except('_token'));
        return back()->with('success', 'berhasil menambah provinsi');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'kabupaten_id' => 'required',
            'nama' => 'required',
        ], [
            'kabupaten_id.required' => 'Kabupaten tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
        ]);
        Kecamatan::find($id)->update($request->except('_token'));
        return back()->with('success', 'berhasil mengubah provinsi');
    }
}
