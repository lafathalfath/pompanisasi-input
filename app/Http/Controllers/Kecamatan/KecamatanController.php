<?php

namespace App\Http\Controllers\Kecamatan;

use App\Http\Controllers\Controller;
use App\Models\LuasTanam;
use App\Models\PompaAbtDimanfaatkan;
use App\Models\PompaAbtDiterima;
use App\Models\PompaAbtUsulan;
use App\Models\Pompanisasi;
use App\Models\PompaRefDimanfaatkan;
use App\Models\PompaRefDiterima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KecamatanController extends Controller
{
    public function index() {
        $user = Auth::user();
        $luas_tanam_harian = 0;
        $ref_diterima = 0;
        $ref_digunakan = 0;
        $abt_usulan = 0;
        $abt_diterima = 0;
        $abt_digunakan = 0;
        
        if ($user->kecamatan) {
            $desa = [];
            foreach ($user->kecamatan->desa as $des) $desa[] = $des->id;
            $ref_diterima = PompaRefDiterima::whereIn('desa_id', $desa)->sum('total_unit');
            $ref_digunakan = PompaRefDimanfaatkan::whereIn('desa_id', $desa)->sum('total_unit');
            $abt_usulan = PompaAbtUsulan::whereIn('desa_id', $desa)->sum('total_unit');
            $abt_diterima = PompaAbtDiterima::whereIn('desa_id', $desa)->sum('total_unit');
            $abt_digunakan = PompaAbtDimanfaatkan::whereIn('desa_id', $desa)->sum('total_unit');
            $luas_tanam_harian = LuasTanam::whereIn('desa_id', $desa)->sum('luas_tanam');
        }
        return view('kecamatan.dashboard', [
            'luas_tanam_harian' => $luas_tanam_harian,
            'ref_diterima' => $ref_diterima,
            'ref_digunakan' => $ref_digunakan,
            'abt_usulan' => $abt_usulan,
            'abt_diterima' => $abt_diterima,
            'abt_digunakan' => $abt_digunakan,
        ]);
    }

    public function storeRefocusingDiterima(Request $request) {
        $request->validate([
            'desa_id' => 'required',
            'nama_poktan' => 'required',
            'luas_lahan' => 'required',
            'total_unit' => 'required',
            'tanggal' => 'required',
            'gambar' => 'required',
        ], [
            'desa_id.required' => 'desa id cannot be null',
            'nama_poktan.required' => 'nama poktan cannot be null',
            'luas_lahan.required' => 'luas lahan cannot be null',
        ]);
        if ($request->hasFile('gambar')) {
            $filename = $request->gambar->hashName();
            $request->gambar->move(storage_path('app/public/pompanisasi'), $filename);
            $url_gambar = "/storage/pompanisasi/$filename";
            $ref_diterima = PompaRefDiterima::create([
                ...$request->except(['_token', 'gambar']),
                'url_gambar' => $url_gambar,
            ]);
            if (!$ref_diterima) return back()->withErrors('gagal mengirim data');
            return redirect()->route('kecamatan.pompa.ref.diterima')->with('success', 'berhasil menambahkan data');
        }
        return back()->withErrors('tidak ada gambar');
    }

    public function storeRefocusingDigunakan(Request $request) {
        $request->validate([
            'desa_id' => 'required',
            'nama_poktan' => 'required',
            'luas_lahan' => 'required',
            'total_unit' => 'required',
            'tanggal' => 'required',
            'gambar' => 'required',
        ], [
            'desa_id.required' => 'desa id cannot be null',
            'nama_poktan.required' => 'nama poktan cannot be null',
            'luas_lahan.required' => 'luas lahan cannot be null',
        ]);
        if ($request->hasFile('gambar')) {
            $filename = $request->gambar->hashName();
            $request->gambar->move(storage_path('app/public/pompanisasi'), $filename);
            $url_gambar = "/storage/pompanisasi/$filename";
            $ref_dimanfaatkan = PompaRefDimanfaatkan::create([
                ...$request->except(['_token', 'gambar']),
                'url_gambar' => $url_gambar,
            ]);
            if (!$ref_dimanfaatkan) return back()->withErrors('gagal mengirim data');
            return redirect()->route('kecamatan.pompa.ref.digunakan')->with('success', 'berhasil menambahkan data');
        }
        return back()->withErrors('tidak ada gambar');
    }

    public function storeAbtUsulan(Request $request) {
        $request->validate([
            'desa_id' => 'required',
            'nama_poktan' => 'required',
            'luas_lahan' => 'required',
            'total_unit' => 'required',
            'tanggal' => 'required',
        ], [
            'desa_id.required' => 'desa id cannot be null',
            'nama_poktan.required' => 'nama poktan cannot be null',
        ]);
        $abt_usulan = PompaAbtUsulan::create($request->except('_token'));
        if (!$abt_usulan) return back()->withErrors('gagal mengirim data');
        return redirect()->route('kecamatan.pompa.abt.usulan')->with('success', 'berhasil menambahkan data');
    }

    public function storeAbtDiterima(Request $request) {
        $request->validate([
            'desa_id' => 'required',
            'nama_poktan' => 'required',
            'luas_lahan' => 'required',
            'total_unit' => 'required',
            'tanggal' => 'required',
            'gambar' => 'required',
        ], [
            'desa_id.required' => 'desa id cannot be null',
            'nama_poktan.required' => 'nama poktan cannot be null',
            'luas_lahan.required' => 'luas lahan cannot be null',
        ]);
        if ($request->hasFile('gambar')) {
            $filename = $request->gambar->hashName();
            $request->gambar->move(storage_path('app/public/pompanisasi'), $filename);
            $url_gambar = "/storage/pompanisasi/$filename";
            $abt_diterima = PompaAbtDiterima::create([
                ...$request->except(['_token', 'gambar']),
                'url_gambar' => $url_gambar,
            ]);
            if (!$abt_diterima) return back()->withErrors('gagal mengirim data');
            return redirect()->route('kecamatan.pompa.abt.diterima')->with('success', 'berhasil menambahkan data');
        }
        return back()->withErrors('tidak ada gambar');
    }

    public function storeAbtDigunakan(Request $request) {
        $request->validate([
            'desa_id' => 'required',
            'nama_poktan' => 'required',
            'luas_lahan' => 'required',
            'total_unit' => 'required',
            'tanggal' => 'required',
            'gambar' => 'required',
        ], [
            'desa_id.required' => 'desa id cannot be null',
            'nama_poktan.required' => 'nama poktan cannot be null',
            'luas_lahan.required' => 'luas lahan cannot be null',
        ]);
        if ($request->hasFile('gambar')) {
            $filename = $request->gambar->hashName();
            $request->gambar->move(storage_path('app/public/pompanisasi'), $filename);
            $url_gambar = "/storage/pompanisasi/$filename";
            $abt_dimanfaatkan = PompaAbtDimanfaatkan::create([
                ...$request->except(['_token', 'gambar']),
                'url_gambar' => $url_gambar,
            ]);
            if (!$abt_dimanfaatkan) return back()->withErrors('gagal mengirim data');
            return redirect()->route('kecamatan.pompa.abt.digunakan')->with('success', 'berhasil menambahkan data');
        }
        return back()->withErrors('tidak ada gambar');
    }
}
