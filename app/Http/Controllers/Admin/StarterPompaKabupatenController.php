<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\StarterAbtDimanfaatkanKabupaten;
use App\Models\StarterAbtDiterimaKabupaten;
use App\Models\StarterAbtUsulanKabupaten;
use App\Models\StarterLuasTanamKabupaten;
use App\Models\StarterRefDimanfaatkanKabupaten;
use App\Models\StarterRefDiterimaKabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StarterPompaKabupatenController extends Controller
{
    // view
    public function ref_diterima_view(Request $request) {
        $kabupaten = [];
        foreach (Kabupaten::get() as $kab) if (!$kab->starter_ref_diterima_kabupaten) $kabupaten[] = $kab;
        $ref_diterima = StarterRefDiterimaKabupaten::paginate(10);
        if ($request->kabupaten) {
            $kabupaten_id = Kabupaten::where('nama', 'LIKE', "%$request->kabupaten%")->distinct()->pluck('id');
            $ref_diterima = StarterRefDiterimaKabupaten::whereIn('kabupaten_id', $kabupaten_id)->paginate(10);
        }
        return view('admin.starter_kabupaten.ref_diterima', ['kabupaten' => $kabupaten, 'ref_diterima' => $ref_diterima]);
    }
    public function ref_dimanfaatkan_view(Request $request) {
        $kabupaten = [];
        foreach (Kabupaten::get() as $kab) if (!$kab->starter_ref_dimanfaatkan_kabupaten) $kabupaten[] = $kab;
        $ref_dimanfaatkan = StarterRefDimanfaatkanKabupaten::paginate(10);
        if ($request->kabupaten) {
            $kabupaten_id = Kabupaten::where('nama', 'LIKE', "%$request->kabupaten%")->distinct()->pluck('id');
            $ref_dimanfaatkan = StarterRefDimanfaatkanKabupaten::whereIn('kabupaten_id', $kabupaten_id)->paginate(10);
        }
        return view('admin.starter_kabupaten.ref_dimanfaatkan', ['kabupaten' => $kabupaten, 'ref_dimanfaatkan' => $ref_dimanfaatkan]);
    }
    public function abt_usulan_view(Request $request) {
        $kabupaten = [];
        foreach (Kabupaten::get() as $kab) if (!$kab->starter_abt_usulan_kabupaten) $kabupaten[] = $kab;
        $abt_usulan = StarterAbtUsulanKabupaten::paginate(10);
        if ($request->kabupaten) {
            $kabupaten_id = Kabupaten::where('nama', 'LIKE', "%$request->kabupaten%")->distinct()->pluck('id');
            $abt_usulan = StarterAbtUsulanKabupaten::whereIn('kabupaten_id', $kabupaten_id)->paginate(10);
        }
        return view('admin.starter_kabupaten.abt_usulan', ['kabupaten' => $kabupaten, 'abt_usulan' => $abt_usulan]);
    }
    public function abt_diterima_view(Request $request) {
        $kabupaten = [];
        foreach (Kabupaten::get() as $kab) if (!$kab->starter_abt_diterima_kabupaten) $kabupaten[] = $kab;
        $abt_diterima = StarterAbtDiterimaKabupaten::paginate(10);
        if ($request->kabupaten) {
            $kabupaten_id = Kabupaten::where('nama', 'LIKE', "%$request->kabupaten%")->distinct()->pluck('id');
            $abt_diterima = StarterAbtDiterimaKabupaten::whereIn('kabupaten_id', $kabupaten_id)->paginate(10);
        }
        return view('admin.starter_kabupaten.abt_diterima', ['kabupaten' => $kabupaten, 'abt_diterima' => $abt_diterima]);
    }
    public function abt_dimanfaatkan_view(Request $request) {
        $kabupaten = [];
        foreach (Kabupaten::get() as $kab) if (!$kab->starter_abt_dimanfaatkan_kabupaten) $kabupaten[] = $kab;
        $abt_dimanfaatkan = StarterAbtDimanfaatkanKabupaten::paginate(10);
        if ($request->kabupaten) {
            $kabupaten_id = Kabupaten::where('nama', 'LIKE', "%$request->kabupaten%")->distinct()->pluck('id');
            $abt_dimanfaatkan = StarterAbtDimanfaatkanKabupaten::whereIn('kabupaten_id', $kabupaten_id)->paginate(10);
        }
        return view('admin.starter_kabupaten.abt_dimanfaatkan', ['kabupaten' => $kabupaten, 'abt_dimanfaatkan' => $abt_dimanfaatkan]);
    }
    public function luas_tanam_view(Request $request) {
        $kabupaten = [];
        foreach (Kabupaten::get() as $kab) if (!$kab->starter_luas_tanam_kabupaten) $kabupaten[] = $kab;
        $luas_tanam = StarterLuasTanamKabupaten::paginate(10);
        if ($request->kabupaten) {
            $kabupaten_id = Kabupaten::where('nama', 'LIKE', "%$request->kabupaten%")->distinct()->pluck('id');
            $luas_tanam = StarterLuasTanamKabupaten::whereIn('kabupaten_id', $kabupaten_id)->paginate(10);
        }
        return view('admin.starter_kabupaten.luas_tanam', ['kabupaten' => $kabupaten, 'luas_tanam' => $luas_tanam]);
    }

    // add
    public function ref_diterima_store(Request $request) {
        $request->validate(['kabupaten_id' => 'required'], ['kabupaten_id.required' => 'kabupaten tidak boleh kosong']);
        $kabupaten = Kabupaten::find($request->kabupaten_id);
        if ($kabupaten->starter_ref_diterima_kabupaten) return back()->withErrors('starter untuk kabupaten ini sudah ada');
        StarterRefDiterimaKabupaten::create([
            'kabupaten_id' => $request->kabupaten_id,
            'total_unit' => $request->total_unit ?  $request->total_unit : 0,
        ]);
        return back()->with('success', 'starter ref_diterima berhasil ditambahkan');
    }
    public function ref_dimanfaatkan_store(Request $request) {
        $request->validate(['kabupaten_id' => 'required'], ['kabupaten_id.required' => 'kabupaten tidak boleh kosong']);
        $kabupaten = Kabupaten::find($request->kabupaten_id);
        if ($kabupaten->starter_ref_dimanfaatkan_kabupaten) return back()->withErrors('starter untuk kabupaten ini sudah ada');
        StarterRefDimanfaatkanKabupaten::create([
            'kabupaten_id' => $request->kabupaten_id,
            'total_unit' => $request->total_unit ?  $request->total_unit : 0,
        ]);
        return back()->with('success', 'starter ref_dimanfaatkan berhasil ditambahkan');
    }
    public function abt_usulan_store(Request $request) {
        $request->validate(['kabupaten_id' => 'required'], ['kabupaten_id.required' => 'kabupaten tidak boleh kosong']);
        $kabupaten = Kabupaten::find($request->kabupaten_id);
        if ($kabupaten->starter_abt_usulan_kabupaten) return back()->withErrors('starter untuk kabupaten ini sudah ada');
        StarterAbtUsulanKabupaten::create([
            'kabupaten_id' => $request->kabupaten_id,
            'total_unit' => $request->total_unit ?  $request->total_unit : 0,
        ]);
        return back()->with('success', 'starter abt_usulan berhasil ditambahkan');
    }
    public function abt_diterima_store(Request $request) {
        $request->validate(['kabupaten_id' => 'required'], ['kabupaten_id.required' => 'kabupaten tidak boleh kosong']);
        $kabupaten = Kabupaten::find($request->kabupaten_id);
        if ($kabupaten->starter_abt_diterima_kabupaten) return back()->withErrors('starter untuk kabupaten ini sudah ada');
        StarterAbtDiterimaKabupaten::create([
            'kabupaten_id' => $request->kabupaten_id,
            'total_unit' => $request->total_unit ?  $request->total_unit : 0,
        ]);
        return back()->with('success', 'starter abt_diterima berhasil ditambahkan');
    }
    public function abt_dimanfaatkan_store(Request $request) {
        $request->validate(['kabupaten_id' => 'required'], ['kabupaten_id.required' => 'kabupaten tidak boleh kosong']);
        $kabupaten = Kabupaten::find($request->kabupaten_id);
        if ($kabupaten->starter_abt_dimanfaatkan_kabupaten) return back()->withErrors('starter untuk kabupaten ini sudah ada');
        StarterAbtDimanfaatkanKabupaten::create([
            'kabupaten_id' => $request->kabupaten_id,
            'total_unit' => $request->total_unit ?  $request->total_unit : 0,
        ]);
        return back()->with('success', 'starter abt_dimanfaatkan berhasil ditambahkan');
    }
    public function luas_tanam_store(Request $request) {
        $request->validate(['kabupaten_id' => 'required'], ['kabupaten_id.required' => 'kabupaten tidak boleh kosong']);
        $kabupaten = Kabupaten::find($request->kabupaten_id);
        if ($kabupaten->starter_luas_tanam_kabupaten) return back()->withErrors('starter untuk kabupaten ini sudah ada');
        StarterLuasTanamKabupaten::create([
            'kabupaten_id' => $request->kabupaten_id,
            'luas_tanam' => $request->luas_tanam ?  $request->luas_tanam : 0,
        ]);
        return back()->with('success', 'starter luas_tanam berhasil ditambahkan');
    }

    // update
    public function ref_diterima_update($id, Request $request) {
        $ref_diterima = StarterRefDiterimaKabupaten::find(Crypt::decryptString($id));
        if (!$ref_diterima) return back()->withErrors('data tidak ditemukan');
        $jumlah = $request->total_unit ? $request->total_unit : 0;
        $ref_diterima->update(['total_unit' => $jumlah]);
        return back()->with('success', 'data berhasil diperbarui');
    }
    public function ref_dimanfaatkan_update($id, Request $request) {
        $ref_dimanfaatkan = StarterRefDimanfaatkanKabupaten::find(Crypt::decryptString($id));
        if (!$ref_dimanfaatkan) return back()->withErrors('data tidak ditemukan');
        $jumlah = $request->total_unit ? $request->total_unit : 0;
        $ref_dimanfaatkan->update(['total_unit' => $jumlah]);
        return back()->with('success', 'data berhasil diperbarui');
    }
    public function abt_usulan_update($id, Request $request) {
        $abt_usulan = StarterAbtUsulanKabupaten::find(Crypt::decryptString($id));
        if (!$abt_usulan) return back()->withErrors('data tidak ditemukan');
        $jumlah = $request->total_unit ? $request->total_unit : 0;
        $abt_usulan->update(['total_unit' => $jumlah]);
        return back()->with('success', 'data berhasil diperbarui');
    }
    public function abt_diterima_update($id, Request $request) {
        $abt_diterima = StarterAbtDiterimaKabupaten::find(Crypt::decryptString($id));
        if (!$abt_diterima) return back()->withErrors('data tidak ditemukan');
        $jumlah = $request->total_unit ? $request->total_unit : 0;
        $abt_diterima->update(['total_unit' => $jumlah]);
        return back()->with('success', 'data berhasil diperbarui');
    }
    public function abt_dimanfaatkan_update($id, Request $request) {
        $abt_dimanfaatkan = StarterAbtDimanfaatkanKabupaten::find(Crypt::decryptString($id));
        if (!$abt_dimanfaatkan) return back()->withErrors('data tidak ditemukan');
        $jumlah = $request->total_unit ? $request->total_unit : 0;
        $abt_dimanfaatkan->update(['total_unit' => $jumlah]);
        return back()->with('success', 'data berhasil diperbarui');
    }
    public function luas_tanam_update($id, Request $request) {
        $luas_tanam = StarterLuasTanamKabupaten::find(Crypt::decryptString($id));
        if (!$luas_tanam) return back()->withErrors('data tidak ditemukan');
        $jumlah = $request->luas_tanam ? $request->luas_tanam : 0;
        $luas_tanam->update(['luas_tanam' => $jumlah]);
        return back()->with('success', 'data berhasil diperbarui');
    }
}
