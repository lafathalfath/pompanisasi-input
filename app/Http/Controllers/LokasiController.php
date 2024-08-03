<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function getKabupaten($provinsi_id)
    {
        $kabupaten = Kabupaten::where('provinsi_id', $provinsi_id)->get();
        return response()->json($kabupaten);
    }

    public function getKecamatan($kabupaten_id)
    {
        $kecamatan = Kecamatan::where('kabupaten_id', $kabupaten_id)->get();
        return response()->json($kecamatan);
    }

    public function getDesa($kecamatan_id)
    {
        $desa = Desa::where('kecamatan_id', $kecamatan_id)->get();
        return response()->json($desa);
    }

    public function storeKecamatan(Request $request) {
        $request->validate([
            'kabupaten_id' => 'required',
            'nama' => 'required',
        ], [
            'kabupaten_id.required' => 'kabupaten id cannot be null',
            'nama.required' => 'nama kecamatan cannot be null',
        ]);
        $kecamatan = Kecamatan::create([
            'nama' => $request->nama,
            'kabupaten_id' => $request->kabupaten_id,
        ]);
        if (!$kecamatan) return redirect()->back()->withErrors('gagal menambahkan kecamatan');
        // dd($kecamatan);
        return redirect()->back()->with('success', 'berhasil menambahkan kecamatan');
    }

    public function storeDesa(Request $request) {
        $request->validate([
            'kecamatan_id' => 'required',
            'nama' => 'required',
        ], [
            'kabupaten_id.required' => 'kecamatan id cannot be null',
            'nama.required' => 'nama desa cannot be null',
        ]);
        $desa = Desa::create([
            'nama' => $request->nama,
            'kecamatan_id' => $request->kecamatan_id,
        ]);
        if (!$desa) return redirect()->back()->withErrors('gagal menambahkan desa');
        return redirect()->back()->with('success', 'berhasil menambahkan desa');
    }
}
