<?php

namespace App\Http\Controllers\Poktan;

use App\Http\Controllers\Controller;
use App\Models\PompaAbt;
use App\Models\Pompanisasi;
use App\Models\PompaRefocusing;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PoktanController extends Controller
{
    public function index() {
        $user = Auth::user();
        if (!$user) return redirect()->route('login')->withErrors('unauthorized');
        $pompanisasi = $user->pompanisasi;
        // dd($pompanisasi);
        return view('poktan.index', ['pompanisasi' => $pompanisasi]);
    }

    public function showForm()
    {
        $provinsi = Provinsi::all();
        return view('poktan.inputPompa', compact('provinsi'));
    }

    public function storePompa(Request $request) {
        // dd(date('Y-m-d'));
        $user = Auth::user();
        if (!$user) return redirect()->route('login.view')->withErrors('unauthorized');
        $request->validate([
            'luas_tanam' => 'required|numeric',
            'pompa_refocusing_usulan' => 'required|numeric',
            'pompa_refocusing_diterima' => 'required|numeric',
            'pompa_refocusing_digunakan' => 'required|numeric',
            'pompa_abt_usulan' => 'required|numeric',
            'pompa_abt_diterima' => 'required|numeric',
            'pompa_abt_digunakan' => 'required|numeric',
            'desa_id' => 'required',
            'gambar' => 'required|mimes:jpeg,png,jpg,gif,heic',
        ], [
            'luas_tanam.required' => 'luas tanam cannot be null',
            'pompa_refocusing_usulan.required' => 'pompa refocusing usulan cannot be null',
            'pompa_refocusing_diterima.required' => 'pompa refocusing diterima cannot be null',
            'pompa_refocusing_digunakan.required' => 'pompa refocusing digunakan cannot be nulll',
            'pompa_abt_usulan.required' => 'pompa abt usulan cannot be null',
            'pompa_abt_diterima.required' => 'pompa abt diterima cannot be null',
            'pompa_abt_digunakan.required' => 'pompa abt digunakan cannot be null',
            'desa_id.required' => 'desa id cannot be null',
            'gambar.required' => 'gambar cannot be null',
            'gambar.mimes' => 'gambar must be in jpeg, png, jpg, gif, or heic',
        ]);
        $cek_pompanisasi = Pompanisasi::where([
            'desa_id' => $request->desa_id,
            'tanggal' => date('Y-m-d'),
        ])->first();
        // dd($cek_pompanisasi);
        if ($cek_pompanisasi) return back()->withErrors('data pompanisasi desa '.$cek_pompanisasi->desa->nama.' pada tanggal '.date('Y-m-d').' telah diinput');
        if (!$request->hasFile('gambar')) return back()->withErrors('gambar diunggah tidak ditemukan atau tidak didukung');
        $filename = $request->gambar->hashName();
        $request->gambar->move(storage_path('app/public/pompanisasi'), $filename);
        $url_gambar = "/storage/pompanisasi/$filename";
        // dd($filename);
        $pompanisasi = Pompanisasi::create([
            'desa_id' => $request->desa_id,
            'poktan_id' => $user->id,
            'luas_tanam' => $request->luas_tanam,
            'tanggal' => date('Y-m-d'),
            'url_gambar' => $url_gambar,
        ]);
        if (!$pompanisasi) return back()->withErrors('gagal menginput data pompanisasi');
        $pompa_refocusing = PompaRefocusing::create([
            'pompanisasi_id' => $pompanisasi->id,
            'usulan' => $request->pompa_refocusing_usulan,
            'diterima' => $request->pompa_refocusing_diterima,
            'digunakan' => $request->pompa_refocusing_digunakan,
        ]);
        if (!$pompa_refocusing) return back()->withErrors('gagal menginput data pompa refocing');
        $pompa_abt = PompaAbt::create([
            'pompanisasi_id' => $pompanisasi->id,
            'usulan' => $request->pompa_abt_usulan,
            'diterima' => $request->pompa_abt_diterima,
            'digunakan' => $request->pompa_abt_digunakan,
        ]);
        if (!$pompa_abt) return back()->withErrors('gagal menginput data pompa abt');
        return redirect()->route('poktan.dashboard')->with('success', 'berhasil menambah pompanisasi');
    }
}
