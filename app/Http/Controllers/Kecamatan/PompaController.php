<?php

namespace App\Http\Controllers\Kecamatan;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\PompaAbtDimanfaatkan;
use App\Models\PompaAbtDiterima;
use App\Models\PompaAbtUsulan;
use App\Models\PompaRefDimanfaatkan;
use App\Models\PompaRefDiterima;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PompaController extends Controller
{
    use ArrayPaginator;
    public function refDiterimaView(Request $request) {
        $user = Auth::user();
        $desa = $user->kecamatan ? $user->kecamatan->desa : [];
        $desa_id = [];
        $ref_diterima = [];
        if ($user->kecamatan) {
            foreach ($desa as $des) {
                $desa_id[] = $des->id;
            }
            if ($request->desa) $desa_id = Desa::where('id', $request->desa)->distinct()->pluck('id');
            $ref_diterima = PompaRefDiterima::whereIn('desa_id', $desa_id);
            if ($request->tanggal) $ref_diterima = $ref_diterima->where('tanggal', $request->tanggal);
            $ref_diterima = $ref_diterima->get();
        }
        $ref_diterima = $this->paginate($ref_diterima, 10);
        return view('kecamatan.refocusing.diterima', ['desa' => $desa, 'ref_diterima' => $ref_diterima]);
    }
    public function refDigunakanView(Request $request) {
        $user = Auth::user();
        $desa = $user->kecamatan ? $user->kecamatan->desa : [];
        $desa_id = [];
        $ref_dimanfaatkan = [];
        if ($user->kecamatan) {
            foreach ($user->kecamatan->desa as $des) {
                $desa_id[] = $des->id;
            }
            if ($request->desa) $desa_id = [$request->desa];
            $ref_dimanfaatkan = PompaRefDimanfaatkan::whereIn('desa_id', $desa_id);
            if ($request->tanggal) $ref_dimanfaatkan = $ref_dimanfaatkan->where('tanggal', $request->tanggal);
            $ref_dimanfaatkan = $ref_dimanfaatkan->get();
        }
        $ref_dimanfaatkan = $this->paginate($ref_dimanfaatkan, 10);
        return view('kecamatan.refocusing.digunakan', ['desa' => $desa, 'ref_dimanfaatkan' => $ref_dimanfaatkan]);
    }
    // detail
    public function refDiterimaDetail($id) {
        $id = Crypt::decryptString($id);
        $ref_diterima = PompaRefDiterima::find($id);
        return view('kecamatan.detailRefocusingDiterima', ['ref_diterima' => $ref_diterima]);
    }
    public function refDigunakanDetail($id) {
        $id = Crypt::decryptString($id);
        $ref_dimanfaatkan = PompaRefDimanfaatkan::find($id);
        return view('kecamatan.detailRefocusingDigunakan', ['ref_dimanfaatkan' => $ref_dimanfaatkan]);
    }


    public function abtUsulanView(Request $request) {
        $user = Auth::user();
        $desa = [];
        $desa_id = [];
        $abt_usulan = [];
        if ($user->kecamatan) {
            $desa = $user->kecamatan->desa;
            foreach ($desa as $des) {
                $desa_id[] = $des->id;
            }
            if ($request->desa) $desa_id = [$request->desa];
            $abt_usulan = PompaAbtUsulan::whereIn('desa_id', $desa_id);
            if ($request->tanggal) $abt_usulan = $abt_usulan->where('tanggal', $request->tanggal);
            $abt_usulan = $abt_usulan->get();
        }
        $abt_usulan = $this->paginate($abt_usulan, 10);
        return view('kecamatan.abt.usulan', ['desa' => $desa, 'abt_usulan' => $abt_usulan]);
    }
    public function abtDiterimaView(Request $request) {
        $user = Auth::user();
        $desa = [];
        $desa_id = [];
        $abt_diterima = [];
        if ($user->kecamatan) {
            $desa = $user->kecamatan->desa;
            foreach ($desa as $des) {
                $desa_id[] = $des->id;
            }
            if ($request->desa) $desa_id = [$request->desa];
            $abt_diterima = PompaAbtDiterima::whereIn('desa_id', $desa_id);
            if ($request->tanggal) $abt_diterima = $abt_diterima->where('tanggal', $request->tanggal);
            $abt_diterima = $abt_diterima->get();
        }
        $abt_diterima = $this->paginate($abt_diterima, 10);
        return view('kecamatan.abt.diterima', ['desa' => $desa, 'abt_diterima' => $abt_diterima]);
    }
    public function abtDigunakanView(Request $request) {
        $user = Auth::user();
        $desa = [];
        $desa_id = [];
        $abt_dimanfaatkan = [];
        if ($user->kecamatan) {
            $desa = $user->kecamatan->desa;
            foreach ($desa as $des) {
                $desa_id[] = $des->id;
            }
            if ($request->desa) $desa_id = [$request->desa];
            $abt_dimanfaatkan = PompaAbtDimanfaatkan::whereIn('desa_id', $desa_id);
            if ($request->tanggal) $abt_dimanfaatkan = $abt_dimanfaatkan->where('tanggal', $request->tanggal);
            $abt_dimanfaatkan = $abt_dimanfaatkan->get();
        }
        $abt_dimanfaatkan = $this->paginate($abt_dimanfaatkan, 10);
        return view('kecamatan.abt.digunakan', ['desa' => $desa, 'abt_dimanfaatkan' => $abt_dimanfaatkan]);
    }
    // detail
    public function abtDiterimaDetail($id) {
        $id = Crypt::decryptString($id);
        $abt_diterima = PompaAbtDiterima::find($id);
        return view('kecamatan.detailAbtDiterima', ['abt_diterima' => $abt_diterima]);
    }
    public function abtDigunakanDetail($id) {
        $id = Crypt::decryptString($id);
        $abt_dimanfaatkan = PompaAbtDimanfaatkan::find($id);
        return view('kecamatan.detailAbtDigunakan', ['abt_dimanfaatkan' => $abt_dimanfaatkan]);
    }

    // form
    public function refocusingDiterima() {
        $user = Auth::user();
        $desa = $user->kecamatan ? $user->kecamatan->desa : [];
        return view('kecamatan.pompaRefocusingDiterimaForm', ['desa' => $desa]);
    }
    public function refocusingDigunakan() {
        $user = Auth::user();
        $desa = $user->kecamatan ? $user->kecamatan->desa : [];
        return view('kecamatan.pompaRefocusingDigunakanForm', ['desa' => $desa]);
    }

    public function abtUsulan() {
        $user = Auth::user();
        $desa = $user->kecamatan ? $user->kecamatan->desa : [];
        return view('kecamatan.pompaAbtUsulanForm', ['desa' => $desa]);
    }
    public function abtDiterima() {
        $user = Auth::user();
        $desa = [];
        $desa = $user->kecamatan ? $user->kecamatan->desa : [];
        return view('kecamatan.pompaAbtDiterimaForm', ['desa' => $desa]);
    }
    public function abtDigunakan() {
        $user = Auth::user();
        $desa = $user->kecamatan ? $user->kecamatan->desa : [];
        return view('kecamatan.pompaAbtDigunakanForm', ['desa' => $desa]);
    }
}
