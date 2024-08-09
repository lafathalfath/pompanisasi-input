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
        $request->validate([
            'desa_id' => 'required',
            'total_unit' => 'required',
        ], [
            'desa_id.required' => 'desa id cannot be null',
        ]);
        $pompanisasi = Pompanisasi::where('desa_id', $request->desa_id)->get()->last();
        if (!$pompanisasi) $pompanisasi = Pompanisasi::create(['desa_id' => $request->desa_id]);
        if ($pompanisasi->pompa_ref_diterima) {
            if ($pompanisasi->pompa_ref_diterima->pompa_ref_dimanfaatkan) {
                PompaRefDiterima::create([...$request->except(['_token', 'desa_id']), 'pompanisasi_id' => $pompanisasi->id]);
                return redirect()->route('kecamatan.pompa.ref.diterima')->with('success', 'berhasil menambahkan data');
            }
            return redirect()->route('kecamatan.pompa.ref.diterima')->withErrors('data pompa refocusing sudah ada');
        }
        PompaRefDiterima::create([...$request->except(['_token', 'desa_id']), 'pompanisasi_id' => $pompanisasi->id]);
        return redirect()->route('kecamatan.pompa.ref.diterima')->with('success', 'berhasil menambahkan data');
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
        $pompanisasi = Pompanisasi::where('desa_id', $request->desa_id)->get()->last();

        if (!$pompanisasi) return redirect()->route('kecamatan.pompa.ref.diterima')->withErrors('data pompa refocusing diterima belum ada');
        if ($pompanisasi && !$pompanisasi->pompa_ref_diterima) return redirect()->route('kecamatan.pompa.ref.diterima')->withErrors('data pompa refocusing diterima belum ada');
        if ($pompanisasi && $pompanisasi->pompa_ref_diterima && $pompanisasi->pompa_ref_diterima->pompa_ref_dimanfaatkan) return redirect()->route('kecamatan.pompa.ref.diterima')->withErrors('data pompa refocusing sudah ada');
        
        $name_gambar = $request->gambar->hashName();
        $request->gambar->move(storage_path('app/public/pompanisasi'), $name_gambar);
        $url_gambar = "/storage/pompanisasi/$name_gambar";
        PompaRefDimanfaatkan::create([
            ...$request->except(['_token', 'desa_id', 'gambar']),
            'pompa_ref_diterima_id' => $pompanisasi->pompa_ref_diterima->id,
            'url_gambar' => $url_gambar,
        ]);
        return redirect()->route('kecamatan.pompa.ref.digunakan')->with('success', 'berhasil menambahkan data');
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
        $pompanisasi = Pompanisasi::where('desa_id', $request->desa_id)->get()->last();
        if (!$pompanisasi) $pompanisasi = Pompanisasi::create(['desa_id' => $request->desa_id]);
        if ($pompanisasi->pompa_abt_usulan) {
            if ($pompanisasi->pompa_abt_usulan->pompa_abt_diterima && $pompanisasi->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan) {
                PompaAbtUsulan::create([...$request->except(['_token', 'desa_id']), 'pompanisasi_id' => $pompanisasi->id]);
                return redirect()->route('kecamatan.pompa.abt.usulan')->with('success', 'berhasil menambahkan data');
            }
            return redirect()->route('kecamatan.pompa.abt.usulan')->withErrors('pompa abt sudah diusulkan');
        }
        PompaAbtUsulan::create([...$request->except(['_token', 'desa_id']), 'pompanisasi_id' => $pompanisasi->id]);
        return redirect()->route('kecamatan.pompa.abt.usulan')->with('success', 'berhasil menambahkan data');
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
