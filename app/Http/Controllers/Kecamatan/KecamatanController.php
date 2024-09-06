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
        $pompa = (object) [
            'luas_tanam' => (object) [
                'total' => 0,
                'terverifikasi' => 0,
                'belum_verifikasi' => 0,
            ],
            'ref_diterima' => (object) [
                'total' => 0,
                'terverifikasi' => 0,
                'belum_verifikasi' => 0,
            ],
            'ref_digunakan' => (object) [
                'total' => 0,
                'terverifikasi' => 0,
                'belum_verifikasi' => 0,
            ],
            'abt_usulan' => (object) [
                'total' => 0,
                'terverifikasi' => 0,
                'belum_verifikasi' => 0,
            ],
            'abt_diterima' => (object) [
                'total' => 0,
                'terverifikasi' => 0,
                'belum_verifikasi' => 0,
            ],
            'abt_digunakan' => (object) [
                'total' => 0,
                'terverifikasi' => 0,
                'belum_verifikasi' => 0,
            ],
        ];
        
        if ($user->kecamatan) {
            $desa = [];
            foreach ($user->kecamatan->desa as $des) $desa[] = $des->id;
            // total
            $pompa->ref_diterima->total = PompaRefDiterima::whereIn('desa_id', $desa)->sum('total_unit');
            $pompa->ref_digunakan->total = PompaRefDimanfaatkan::whereIn('desa_id', $desa)->sum('total_unit');
            $pompa->abt_usulan->total = PompaAbtUsulan::whereIn('desa_id', $desa)->sum('total_unit');
            $pompa->abt_diterima->total = PompaAbtDiterima::whereIn('desa_id', $desa)->sum('total_unit');
            $pompa->abt_digunakan->total = PompaAbtDimanfaatkan::whereIn('desa_id', $desa)->sum('total_unit');
            $pompa->luas_tanam->total = LuasTanam::whereIn('desa_id', $desa)->sum('luas_tanam');
            // terverifikasi
            $pompa->ref_diterima->terverifikasi = PompaRefDiterima::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('total_unit');
            $pompa->ref_digunakan->terverifikasi = PompaRefDimanfaatkan::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('total_unit');
            $pompa->abt_usulan->terverifikasi = PompaAbtUsulan::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('total_unit');
            $pompa->abt_diterima->terverifikasi = PompaAbtDiterima::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('total_unit');
            $pompa->abt_digunakan->terverifikasi = PompaAbtDimanfaatkan::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('total_unit');
            $pompa->luas_tanam->terverifikasi = LuasTanam::whereIn('desa_id', $desa)->where('verified_at', '!=', null)->sum('luas_tanam');
            // belum_verifikasi
            $pompa->ref_diterima->belum_verifikasi = PompaRefDiterima::whereIn('desa_id', $desa)->where('verified_at', null)->sum('total_unit');
            $pompa->ref_digunakan->belum_verifikasi = PompaRefDimanfaatkan::whereIn('desa_id', $desa)->where('verified_at', null)->sum('total_unit');
            $pompa->abt_usulan->belum_verifikasi = PompaAbtUsulan::whereIn('desa_id', $desa)->where('verified_at', null)->sum('total_unit');
            $pompa->abt_diterima->belum_verifikasi = PompaAbtDiterima::whereIn('desa_id', $desa)->where('verified_at', null)->sum('total_unit');
            $pompa->abt_digunakan->belum_verifikasi = PompaAbtDimanfaatkan::whereIn('desa_id', $desa)->where('verified_at', null)->sum('total_unit');
            $pompa->luas_tanam->belum_verifikasi = LuasTanam::whereIn('desa_id', $desa)->where('verified_at', null)->sum('luas_tanam');
        }
        return view('kecamatan.dashboard', [
            'pompa' => $pompa
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
