<?php

namespace App\Http\Controllers\Kecamatan;

use App\Http\Controllers\Controller;
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
        return view('kecamatan.dashboard');
    }

    public function storeRefocusingDiterima(Request $request) {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');
        $request->validate([
            'desa_id' => 'required',
            'nama_poktan' => 'required',
        ], [
            'desa_id.required' => 'desa id cannot be null',
            'nama_poktan.required' => 'nama poktan cannot be null',
        ]);
        $diterima = PompaRefDiterima::create([...$request->except(['_token', 'desa_id']), 'tanggal' => date('Y-m-d')]);
        if (!$diterima) return back()->withErrors('gagal menambahkan data');
        $pompanisasi_kec = Pompanisasi::where([
            ['desa_id', '=', $request->desa_id],
            ['pompa_ref_kec_diterima_id', '=', $diterima->id],
        ])->first();
        if (!$pompanisasi_kec) {
            Pompanisasi::create([
                'desa_id' => $request->desa_id,
                'luas_lahan' => $request->luas_lahan ? $request->luas_lahan : 0,
                'pompa_ref_kec_diterima_id' => $diterima->id,
            ]);
        } else {
            $pompanisasi_kec->update([
                'desa_id' => $request->desa_id,
                'luas_lahan' => $request->luas_lahan ? $pompanisasi_kec->luas_lahan + $request->luas_lahan : 0,
                'pompa_ref_kec_diterima_id' => $diterima->id,
            ]);
        }
        return redirect()->route('kecamatan.pompa.ref.diterima')->with('success', 'berhasil menambahkan data');
    }

    public function storeRefocusingDigunakan(Request $request) {
        // dd([...$request->all(), 'tes' => 'testestes']);
        $user = Auth::user();
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
        $name_gambar = $request->gambar->hashName();
        $request->gambar->move(storage_path('app/public/pompanisasi'), $name_gambar);
        $url_gambar = "/storage/pompanisasi/$name_gambar";
        // dd($name_gambar);
        $pompanisasi = Pompanisasi::where('desa_id', $request->desa_id)->first();
        if (!$pompanisasi) $pompanisasi = Pompanisasi::create(['desa_id' => $request->desa_id]);
        PompaRefDimanfaatkan::create([
            ...$request->except(['_token', 'desa_id', 'gambar']),
            'pompanisasi_id' => $pompanisasi->id,
            'url_gambar' => $url_gambar,
        ]);
        return redirect()->route('kecamatan.pompa.ref.digunakan')->with('success', 'berhasil menambahkan data');
    }

    public function storeAbtUsulan(Request $request) {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');
        $request->validate([
            'desa_id' => 'required',
            'nama_poktan' => 'required',
        ], [
            'desa_id.required' => 'desa id cannot be null',
            'nama_poktan.required' => 'nama poktan cannot be null',
        ]);
        $usulan = PompaAbtUsulan::create([...$request->except(['_token', 'desa_id']), 'tanggal' => date('Y-m-d')]);
        if (!$usulan) return back()->withErrors('gagal menambahkan data');
        $pompanisasi_kec = Pompanisasi::where([
            ['desa_id', '=', $request->desa_id],
            ['pompa_abt_kec_usulan_id', '=', $usulan->id],
        ])->first();
        if (!$pompanisasi_kec) {
            Pompanisasi::create([
                'desa_id' => $request->desa_id,
                'luas_lahan' => $request->luas_lahan ? $request->luas_lahan : 0,
                'pompa_abt_kec_usulan_id' => $usulan->id,
            ]);
        } else {
            $pompanisasi_kec->update([
                'desa_id' => $request->desa_id,
                'luas_lahan' => $request->luas_lahan ? $pompanisasi_kec->luas_lahan + $request->luas_lahan : 0,
                'pompa_abt_kec_usulan_id' => $usulan->id,
            ]);
        }
        return redirect()->route('kecamatan.dashboard')->with('success', 'berhasil menambahkan data');
    }

    public function storeAbtDiterima(Request $request) {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');
        $request->validate([
            'desa_id' => 'required',
            'nama_poktan' => 'required',
        ], [
            'desa_id.required' => 'desa id cannot be null',
            'nama_poktan.required' => 'nama poktan cannot be null',
        ]);
        $diterima = PompaAbtDiterima::create([...$request->except(['_token', 'desa_id']), 'tanggal' => date('Y-m-d')]);
        if (!$diterima) return back()->withErrors('gagal menambahkan data');
        $pompanisasi_kec = Pompanisasi::where([
            ['desa_id', '=', $request->desa_id],
            ['pompa_abt_kec_diterima_id', '=', $diterima->id],
        ])->first();
        if (!$pompanisasi_kec) {
            Pompanisasi::create([
                'desa_id' => $request->desa_id,
                'luas_lahan' => $request->luas_lahan ? $request->luas_lahan : 0,
                'pompa_abt_kec_diterima_id' => $diterima->id,
            ]);
        } else {
            $pompanisasi_kec->update([
                'desa_id' => $request->desa_id,
                'luas_lahan' => $request->luas_lahan ? $pompanisasi_kec->luas_lahan + $request->luas_lahan : 0,
                'pompa_abt_kec_diterima_id' => $diterima->id,
            ]);
        }
        return redirect()->route('kecamatan.dashboard')->with('success', 'berhasil menambahkan data');
    }

    public function storeAbtDigunakan(Request $request) {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');
        $request->validate([
            'desa_id' => 'required',
            'nama_poktan' => 'required',
            'luas_terairi' => 'required',
        ], [
            'desa_id.required' => 'desa id cannot be null',
            'nama_poktan.required' => 'nama poktan cannot be null',
            'luas_terairi.required' => 'luas terairi cannot be null',
        ]);
        $digunakan = PompaAbtDimanfaatkan::create([...$request->except(['_token', 'desa_id']), 'tanggal' => date('Y-m-d')]);
        if (!$digunakan) return back()->withErrors('gagal menambahkan data');
        $pompanisasi_kec = Pompanisasi::where([
            ['desa_id', '=', $request->desa_id],
            ['pompa_abt_kec_digunakan_id', '=', $digunakan->id],
        ])->first();
        if (!$pompanisasi_kec) {
            Pompanisasi::create([
                'desa_id' => $request->desa_id,
                'luas_lahan' => $request->luas_lahan ? $request->luas_lahan : 0,
                'pompa_abt_kec_digunakan_id' => $digunakan->id,
            ]);
        } else {
            $pompanisasi_kec->update([
                'desa_id' => $request->desa_id,
                'luas_lahan' => $request->luas_lahan ? $pompanisasi_kec->luas_lahan + $request->luas_lahan : 0,
                'pompa_abt_kec_digunakan_id' => $digunakan->id,
            ]);
        }
        return redirect()->route('kecamatan.dashboard')->with('success', 'berhasil menambahkan data');
    }
}
