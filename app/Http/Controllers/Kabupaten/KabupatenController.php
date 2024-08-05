<?php

namespace App\Http\Controllers\Kabupaten;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\PompanisasiKec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KabupatenController extends Controller
{
    public function index() {
        $user = Auth::user();
        if (!$user) return redirect()->route('login')->withErrors('unauthorized');

        $kecamatan = $user->kabupaten ? $user->kabupaten->kecamatan : [];
        $expand_kecamatan = [];
        foreach ($kecamatan as $kec) {
            foreach ($kec->desa as $des) {
                $luas_tanam = 0;
                $nama_poktan = [];
                $pompa_refocusing = (object) [
                    'usulan' => 0,
                    'diterima' => 0,
                    'digunakan' => 0,
                ];
                $pompa_abt = (object) [
                    'usulan' => 0,
                    'diterima' => 0,
                    'digunakan' => 0,
                ];
                foreach ($des->pompanisasi as $pom) {
                    $luas_tanam += $pom->luas_tanam;
                    $nama_poktan[] = $pom->poktan->nama;
                    if ($pom->pompa_refocusing) {
                        $pompa_refocusing->usulan += $pom->pompa_refocusing->usulan;
                        $pompa_refocusing->diterima += $pom->pompa_refocusing->diterima;
                        $pompa_refocusing->digunakan += $pom->pompa_refocusing->digunakan;
                    }
                    if ($pom->pompa_abt) {
                        $pompa_abt->usulan += $pom->pompa_abt->usulan;
                        $pompa_abt->diterima += $pom->pompa_abt->diterima;
                        $pompa_abt->digunakan += $pom->pompa_abt->digunakan;
                    }
                }
                $expand_kecamatan[] = (object) [
                    'kecamatan' => $des->kecamatan,
                    'desa' => $des,
                    'luas_tanam' => $luas_tanam,
                    'nama_poktan' => array_unique($nama_poktan),
                    'pompanisasi' => (object) [
                        'pompa_refocusing' => $pompa_refocusing,
                        'pompa_abt' => $pompa_abt,
                    ],
                ];
            }
        }

        // dd($expand_kecamatan);
        return view('kabupaten.dashboard', [
            'kecamatan' => $kecamatan,
            'expand_kecamatan' => $expand_kecamatan,
        ]);
    }

    public function verifikasiDataView() {
        return view('kabupaten.verifikasiData');
    }

    public function verifikasiData($pompanisasi_kec_id) {
        $pompanisasi_kec = PompanisasiKec::find($pompanisasi_kec_id);
        if (!$pompanisasi_kec) return back()->withErrors('data tidak ditemukan');
        if ($pompanisasi_kec->verified_at) return back()->withErrors('data sudah terverifikasi');
        $pompanisasi_kec->update([
            'verified_at' => date('Y-m-d H:i:s'),
        ]);
        return back()->with('success', 'berhasil verifikasi data');
    }
}
