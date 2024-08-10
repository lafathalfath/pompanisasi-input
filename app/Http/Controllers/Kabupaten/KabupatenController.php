<?php

namespace App\Http\Controllers\Kabupaten;

use App\Http\Controllers\Controller;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KabupatenController extends Controller
{
    public function index() {
        $user = Auth::user();
        $kecamatan = [];
        $luas_tanam_harian = [];
        if ($user->kabupaten) {
            $kecamatan = $user->kabupaten->kecamatan;
            foreach ($kecamatan as $kec) {
                // $luas_tanam = 0;
                foreach ($kec->desa as $des) {
                    if ($des->luas_tanam) foreach ($des->luas_tanam as $lt) {
                        $luas_tanam_harian[] = $lt;
                    }
                }
                // if ($luas_tanam > 0) $luas_tanam_harian[] = (object) [
                //     'kecamatan' => $kec->nama,
                //     'luas_tanam' => $luas_tanam,
                // ];
            }
        }
        // dd($luas_tanam_harian);
        return view('kabupaten.dashboard', ['luas_tanam_harian' => $luas_tanam_harian]);
    }

    public function verifikasiDataView() {
        return view('kabupaten.verifikasiData');
    }

    public function verifikasiData($pompanisasi_kec_id) {
        return back()->with('success', 'berhasil verifikasi data');
    }
}
