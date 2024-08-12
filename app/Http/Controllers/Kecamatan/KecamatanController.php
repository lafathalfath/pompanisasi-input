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
        $luas_tanam_harian = [];
        $ref_diterima = 0;
        $ref_digunakan = 0;
        $abt_usulan = 0;
        $abt_diterima = 0;
        $abt_digunakan = 0;
        foreach ($desa as $des) {
            if ($des->luas_tanam) foreach ($des->luas_tanam as $lt) {
                $luas_tanam_harian[] = $lt;
            }
            if ($des->pompanisasi) foreach ($des->pompanisasi as $pom) {
                if ($pom->pompa_ref_diterima) {
                    $ref_diterima += $pom->pompa_ref_diterima->total_unit;
                    if ($pom->pompa_ref_diterima->pompa_ref_dimanfaatkan) $ref_digunakan += $pom->pompa_ref_diterima->pompa_ref_dimanfaatkan->total_unit;
                }
                if ($pom->pompa_abt_usulan) {
                    $abt_usulan += $pom->pompa_abt_usulan->total_unit;
                    if ($pom->pompa_abt_usulan->pompa_abt_diterima) {
                        $abt_diterima += $pom->pompa_abt_usulan->pompa_abt_diterima->total_unit;
                        if ($pom->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan) $abt_digunakan += $pom->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan->total_unit;
                    }
                }
            }
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
            'total_unit' => 'required',
        ], [
            'desa_id.required' => 'desa id cannot be null',
        ]);
        $pompanisasi = Pompanisasi::where('desa_id', $request->desa_id)->get()->last();
        if ($pompanisasi && $pompanisasi->pompa_ref_diterima) {
            if ($pompanisasi->pompa_ref_diterima->pompa_ref_dimanfaatkan) {
                $pompanisasi = Pompanisasi::create(['desa_id' => $request->desa_id]);
                PompaRefDiterima::create([...$request->except(['_token', 'desa_id']), 'pompanisasi_id' => $pompanisasi->id]);
                return redirect()->route('kecamatan.pompa.ref.diterima')->with('success', 'berhasil menambahkan data');
            }
            return redirect()->route('kecamatan.pompa.ref.diterima')->withErrors('data pompa refocusing sudah ada');
        }
        if (!$pompanisasi) $pompanisasi = Pompanisasi::create(['desa_id' => $request->desa_id]);
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
        if ($pompanisasi && $pompanisasi->pompa_abt_usulan) {
            if ($pompanisasi->pompa_abt_usulan->pompa_abt_diterima && $pompanisasi->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan) {
                $pompanisasi = Pompanisasi::create(['desa_id' => $request->desa_id]);
                PompaAbtUsulan::create([...$request->except(['_token', 'desa_id']), 'pompanisasi_id' => $pompanisasi->id]);
                return redirect()->route('kecamatan.pompa.abt.usulan')->with('success', 'berhasil menambahkan data');
            }
            return redirect()->route('kecamatan.pompa.abt.usulan')->withErrors('pompa abt sudah diusulkan');
        }
        if (!$pompanisasi) $pompanisasi = Pompanisasi::create(['desa_id' => $request->desa_id]);
        PompaAbtUsulan::create([...$request->except(['_token', 'desa_id']), 'pompanisasi_id' => $pompanisasi->id]);
        return redirect()->route('kecamatan.pompa.abt.usulan')->with('success', 'berhasil menambahkan data');
    }

    public function storeAbtDiterima(Request $request) {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');
        $request->validate([
            'desa_id' => 'required',
            'total_unit' => 'required',
        ], [
            'desa_id.required' => 'desa id cannot be null',
            'total_unit.required' => 'total unit cannot be null',
        ]);
        $pompanisasi = Pompanisasi::where('desa_id', $request->desa_id)->get()->last();
        if (!$pompanisasi) return redirect()->route('kecamatan.pompa.abt.diterima')->withErrors('pompanisasi tidak ditemukan');
        if (!$pompanisasi->pompa_abt_usulan)  return redirect()->route('kecamatan.pompa.abt.diterima')->withErrors('data pompa abt diusulkan tidak ada');
        if ($pompanisasi->pompa_abt_usulan && $pompanisasi->pompa_abt_usulan->pompa_abt_diterima) return redirect()->route('kecamatan.pompa.abt.diterima')->withErrors('data sudah ada');
        PompaAbtDiterima::create([
            ...$request->except(['_token', 'desa_id']),
            'pompa_abt_usulan_id' => $pompanisasi->pompa_abt_usulan->id,
        ]);
        return redirect()->route('kecamatan.pompa.abt.diterima')->with('success', 'berhasil menambahkan data');
    }

    public function storeAbtDigunakan(Request $request) {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');
        $request->validate([
            'desa_id' => 'required',
            'nama_poktan' => 'required',
            'luas_lahan' => 'required',
            'total_unit' => 'required',
            'gambar' => 'required',
            'tanggal' => 'required',
        ], [
            'desa_id.required' => 'desa id cannot be null',
            'nama_poktan.required' => 'nama poktan cannot be null',
            'luas_lahan.required' => 'luas lahan cannot be null',
        ]);
        $pompanisasi = Pompanisasi::where('desa_id', $request->desa_id)->get()->last();
        if (!$pompanisasi) return redirect()->route('kecamatan.pompa.abt.digunakan')->withErrors('pompanisasi tidak ditemukan');
        if (!$pompanisasi->pompa_abt_usulan) return redirect()->route('kecamatan.pompa.abt.diterima')->withErrors('data pompa abt diusulkan tidak ada');
        if ($pompanisasi->pompa_abt_usulan && !$pompanisasi->pompa_abt_usulan->pompa_abt_diterima) return redirect()->route('kecamatan.pompa.abt.diterima')->withErrors('data pompa abt diterima tidak ada');
        if ($pompanisasi->pompa_abt_usulan && $pompanisasi->pompa_abt_usulan->pompa_abt_diterima && $pompanisasi->pompa_abt_usulan->pompa_abt_diterima->pompa_abt_dimanfaatkan) return redirect()->route('kecamatan.pompa.abt.diterima')->withErrors('data pompa abt dimanfaatkan sudah ada');
        
        $filename = $request->gambar->hashName();
        $request->gambar->move(storage_path('app/public/pompanisasi'), $filename);
        $url_gambar = "/storage/pompanisasi/$filename";
        PompaAbtDimanfaatkan::create([
            ...$request->except(['_token', 'desa_id', 'gambar']),
            'pompa_abt_diterima_id' => $pompanisasi->pompa_abt_usulan->pompa_abt_diterima->id,
            'url_gambar' => $url_gambar,
        ]);
        return redirect()->route('kecamatan.pompa.abt.digunakan')->with('success', 'berhasil menambahkan data');
    }
}
