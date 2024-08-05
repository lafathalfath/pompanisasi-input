<?php

namespace App\Http\Controllers\Kecamatan;

use App\Http\Controllers\Controller;
use App\Models\PompaAbtKecDigunakan;
use App\Models\PompaAbtKecDiterima;
use App\Models\PompaAbtKecUsulan;
use App\Models\PompanisasiKec;
use App\Models\PompaRefKecDigunakan;
use App\Models\PompaRefKecDiterima;
use App\Models\PompaRefKecUsulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KecamatanController extends Controller
{
    public function index() {
        return view('kecamatan.dashboard');
    }

    public function storeRefocusingUsulan(Request $request) {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');
        $request->validate([
            'desa_id' => 'required',
            'nama_poktan' => 'required',
        ], [
            'desa_id.required' => 'desa id cannot be null',
            'nama_poktan.required' => 'nama poktan cannot be null',
        ]);
        $usulan = PompaRefKecUsulan::create([...$request->except(['_token', 'desa_id']), 'tanggal' => date('Y-m-d')]);
        if (!$usulan) return back()->withErrors('gagal menambahkan data');
        $pompanisasi_kec = PompanisasiKec::where([
            ['desa_id', '=', $request->desa_id],
            ['pompa_ref_kec_usulan_id', '=', $usulan->id],
        ])->first();
        if (!$pompanisasi_kec) {
            PompanisasiKec::create([
                'desa_id' => $request->desa_id,
                'luas_lahan' => $request->luas_lahan ? $request->luas_lahan : 0,
                'pompa_ref_kec_usulan_id' => $usulan->id,
            ]);
        } else {
            $pompanisasi_kec->update([
                'desa_id' => $request->desa_id,
                'luas_lahan' => $request->luas_lahan ? $pompanisasi_kec->luas_lahan + $request->luas_lahan : 0,
                'pompa_ref_kec_usulan_id' => $usulan->id,
            ]);
        }
        return redirect()->route('kecamatan.dashboard')->with('success', 'berhasil menambahkan data');
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
        $diterima = PompaRefKecDiterima::create([...$request->except(['_token', 'desa_id']), 'tanggal' => date('Y-m-d')]);
        if (!$diterima) return back()->withErrors('gagal menambahkan data');
        $pompanisasi_kec = PompanisasiKec::where([
            ['desa_id', '=', $request->desa_id],
            ['pompa_ref_kec_diterima_id', '=', $diterima->id],
        ])->first();
        if (!$pompanisasi_kec) {
            PompanisasiKec::create([
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
        return redirect()->route('kecamatan.dashboard')->with('success', 'berhasil menambahkan data');
    }

    public function storeRefocusingDigunakan(Request $request) {
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
        $digunakan = PompaRefKecDigunakan::create([...$request->except(['_token', 'desa_id']), 'tanggal' => date('Y-m-d')]);
        if (!$digunakan) return back()->withErrors('gagal menambahkan data');
        $pompanisasi_kec = PompanisasiKec::where([
            ['desa_id', '=', $request->desa_id],
            ['pompa_ref_kec_digunakan_id', '=', $digunakan->id],
        ])->first();
        if (!$pompanisasi_kec) {
            PompanisasiKec::create([
                'desa_id' => $request->desa_id,
                'luas_lahan' => $request->luas_lahan ? $request->luas_lahan : 0,
                'pompa_ref_kec_digunakan_id' => $digunakan->id,
            ]);
        } else {
            $pompanisasi_kec->update([
                'desa_id' => $request->desa_id,
                'luas_lahan' => $request->luas_lahan ? $pompanisasi_kec->luas_lahan + $request->luas_lahan : 0,
                'pompa_ref_kec_digunakan_id' => $digunakan->id,
            ]);
        }
        return redirect()->route('kecamatan.dashboard')->with('success', 'berhasil menambahkan data');
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
        $usulan = PompaAbtKecUsulan::create([...$request->except(['_token', 'desa_id']), 'tanggal' => date('Y-m-d')]);
        if (!$usulan) return back()->withErrors('gagal menambahkan data');
        $pompanisasi_kec = PompanisasiKec::where([
            ['desa_id', '=', $request->desa_id],
            ['pompa_abt_kec_usulan_id', '=', $usulan->id],
        ])->first();
        if (!$pompanisasi_kec) {
            PompanisasiKec::create([
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
        $diterima = PompaAbtKecDiterima::create([...$request->except(['_token', 'desa_id']), 'tanggal' => date('Y-m-d')]);
        if (!$diterima) return back()->withErrors('gagal menambahkan data');
        $pompanisasi_kec = PompanisasiKec::where([
            ['desa_id', '=', $request->desa_id],
            ['pompa_abt_kec_diterima_id', '=', $diterima->id],
        ])->first();
        if (!$pompanisasi_kec) {
            PompanisasiKec::create([
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
        $digunakan = PompaAbtKecDigunakan::create([...$request->except(['_token', 'desa_id']), 'tanggal' => date('Y-m-d')]);
        if (!$digunakan) return back()->withErrors('gagal menambahkan data');
        $pompanisasi_kec = PompanisasiKec::where([
            ['desa_id', '=', $request->desa_id],
            ['pompa_abt_kec_digunakan_id', '=', $digunakan->id],
        ])->first();
        if (!$pompanisasi_kec) {
            PompanisasiKec::create([
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
