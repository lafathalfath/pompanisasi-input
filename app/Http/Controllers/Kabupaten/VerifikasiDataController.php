<?php

namespace App\Http\Controllers\Kabupaten;

use App\Http\Controllers\Controller;
use App\Models\LuasTanam;
use App\Models\PompaAbtDimanfaatkan;
use App\Models\PompaAbtDiterima;
use App\Models\PompaAbtUsulan;
use App\Models\PompaRefDimanfaatkan;
use App\Models\PompaRefDiterima;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class VerifikasiDataController extends Controller
{
    use ArrayPaginator;

    public function refDiterimaView() {
        $user = Auth::user();
        $ref_diterima = [];
        if ($user->kabupaten) foreach ($user->kabupaten->kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_ref_diterima as $rdt) {
            $ref_diterima[] = $rdt;
        }
        $ref_diterima = $this->paginate($ref_diterima, 10);
        return view('kabupaten.verifdata.verifRefDiterima', ['ref_diterima' => $ref_diterima]);
    }

    public function refDimanfaatkanView() {
        $user = Auth::user();
        $ref_dimanfaatkan = [];
        if ($user->kabupaten) foreach ($user->kabupaten->kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_ref_dimanfaatkan as $rdm) {
            $ref_dimanfaatkan[] = $rdm;
        }
        $ref_dimanfaatkan = $this->paginate($ref_dimanfaatkan, 10);
        return view('kabupaten.verifdata.verifRefDigunakan', ['ref_dimanfaatkan' => $ref_dimanfaatkan]);
    }

    public function abtUsulanView() {
        $user = Auth::user();
        $abt_usulan = [];
        if ($user->kabupaten) foreach ($user->kabupaten->kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_abt_usulan as $aus) {
            $abt_usulan[] = $aus;
        }
        $abt_usulan = $this->paginate($abt_usulan, 10);
        return view('kabupaten.verifdata.verifAbtUsulan', ['abt_usulan' => $abt_usulan]);
    }

    public function abtDiterimaView() {
        $user = Auth::user();
        $abt_diterima = [];
        if ($user->kabupaten) foreach ($user->kabupaten->kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_abt_diterima as $adt) {
            $abt_diterima[] = $adt;
        }
        $abt_diterima = $this->paginate($abt_diterima, 10);
        return view('kabupaten.verifdata.verifAbtDiterima', ['abt_diterima' => $abt_diterima]);
    }

    public function abtDimanfaatkanView() {
        $user = Auth::user();
        $abt_dimanfaatkan = [];
        if ($user->kabupaten) foreach ($user->kabupaten->kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->pompa_abt_dimanfaatkan as $adm) {
            $abt_dimanfaatkan[] = $adm;
        }
        $abt_dimanfaatkan = $this->paginate($abt_dimanfaatkan, 10);
        return view('kabupaten.verifdata.verifAbtDigunakan', ['abt_dimanfaatkan' => $abt_dimanfaatkan]);
    }

    public function luasTanamView() {
        $user = Auth::user();
        $luas_tanam = [];
        if ($user->kabupaten) foreach ($user->kabupaten->kecamatan as $kec) foreach ($kec->desa as $des) foreach ($des->luas_tanam as $lt) {
            $luas_tanam[] = $lt;
        }
        $luas_tanam = $this->paginate($luas_tanam, 10);
        return view('kabupaten.verifdata.verifLuasTanamHarian', ['luas_tanam' => $luas_tanam]);
    }

    // verification
    public function refDiterimaVerif($id) {
        $id = Crypt::decryptString($id);
        $ref_diterima = PompaRefDiterima::find($id);
        $ref_diterima->update(['verified_at' => now()]);
        return back()->with('success', 'berhasil verifikasi data');
    }

    public function refDimanfaatkanVerif($id) {
        $id = Crypt::decryptString($id);
        $ref_dimanfaatkan = PompaRefDimanfaatkan::find($id);
        $ref_dimanfaatkan->update(['verified_at' => now()]);
        return back()->with('success', 'berhasil verifikasi data');
    }

    public function abtUsulanVerif($id) {
        $id = Crypt::decryptString($id);
        $abt_usulan = PompaAbtUsulan::find($id);
        $abt_usulan->update(['verified_at' => now()]);
        return back()->with('success', 'berhasil verifikasi data');
    }

    public function abtDiterimaVerif($id) {
        $id = Crypt::decryptString($id);
        $abt_diterima = PompaAbtDiterima::find($id);
        $abt_diterima->update(['verified_at' => now()]);
        return back()->with('success', 'berhasil verifikasi data');
    }

    public function abtDimanfaatkanVerif($id) {
        $id = Crypt::decryptString($id);
        $abt_dimanfaatkan = PompaAbtDimanfaatkan::find($id);
        $abt_dimanfaatkan->update(['verified_at' => now()]);
        return back()->with('success', 'berhasil verifikasi data');
    }

    public function luasTanamVerif($id) {
        $id = Crypt::decryptString($id);
        $luas_tanam = LuasTanam::find($id);
        $luas_tanam->update(['verified_at' => now()]);
        return back()->with('success', 'berhasil verifikasi data');
    }
}
