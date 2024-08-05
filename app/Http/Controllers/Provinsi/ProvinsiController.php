<?php

namespace App\Http\Controllers\Provinsi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvinsiController extends Controller
{
    public function index() {
        $user = Auth::user();
        if (!$user) return redirect()->route('login.view')->withErrors('unauthorized');

        $kabupaten = $user->provinsi->kabupaten;
        $expand_kabupaten = [];
        
        foreach ($kabupaten as $kab) {
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

            foreach ($kab->pompanisasi as $pom) {
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

            $expand_kabupaten[] = (object) [
                'kabupaten' => $kab->nama, // Assuming $kab->nama contains the name of the kabupaten
                'luas_tanam' => $luas_tanam,
                'nama_poktan' => array_unique($nama_poktan),
                'pompanisasi' => (object) [
                    'pompa_refocusing' => $pompa_refocusing,
                    'pompa_abt' => $pompa_abt,
                ],
            ];
        }

        return view('provinsi.dashboard', [
            'kabupaten' => $kabupaten,
            'expand_kabupaten' => $expand_kabupaten,
        ]);
    }

    public function verifikasiData() {
        return view('provinsi.verifikasiData');
    }
}
