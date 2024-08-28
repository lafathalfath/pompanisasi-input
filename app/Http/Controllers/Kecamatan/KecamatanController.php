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
        $user = Auth::user();
        $desa = $user->kecamatan ? $user->kecamatan->desa : [];
        $luas_tanam_harian = 0;
        $ref_diterima = 0;
        $ref_digunakan = 0;
        $abt_usulan = 0;
        $abt_diterima = 0;
        $abt_digunakan = 0;
        foreach ($desa as $des) {
            if ($des->luas_tanam && !empty($des->luas_tanam)) foreach ($des->luas_tanam as $lt) $luas_tanam_harian += $lt->luas_tanam;
            if ($des->pompa_ref_diterima && !empty($des->pompa_ref_diterima)) foreach ($des->pompa_ref_diterima as $rdt) $ref_diterima += $rdt->total_unit;
            if ($des->pompa_ref_dimanfaatkan && !empty($des->pompa_ref_dimanfaatkan)) foreach ($des->pompa_ref_dimanfaatkan as $rdm) $ref_digunakan += $rdm->total_unit;
            if ($des->pompa_abt_usulan && !empty($des->pompa_abt_usulan)) foreach ($des->pompa_abt_usulan as $aus) $abt_usulan += $aus->total_unit;
            if ($des->pompa_abt_diterima && !empty($des->pompa_abt_diterima)) foreach ($des->pompa_abt_diterima as $adt) $abt_diterima += $adt->total_unit;
            if ($des->pompa_abt_dimanfaatkan && !empty($des->pompa_abt_dimanfaatkan)) foreach ($des->pompa_abt_diterima as $adm) $abt_digunakan += $adm->total_unit;
        }

        // $luas_tanam_harian = $luas_tanam_harian->paginate(10);
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
            $url_gambar = "/storeage/pompanisasi/$filename";
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
            $url_gambar = "/storeage/pompanisasi/$filename";
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
            $url_gambar = "/storeage/pompanisasi/$filename";
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
            $url_gambar = "/storeage/pompanisasi/$filename";
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
