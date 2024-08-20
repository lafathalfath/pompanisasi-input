<?php

namespace App\Http\Controllers\Kecamatan;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\PompaAbtDimanfaatkan;
use App\Models\PompaRefDimanfaatkan;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PompaController extends Controller
{
    use ArrayPaginator;
    public function refDiterimaView() {
        $user = Auth::user();
        $desa = $user->kecamatan ? $user->kecamatan->desa : [];
        $ref_diterima = [];
        if ($user->kecamatan) {
            foreach ($user->kecamatan->desa as $des) {
                foreach ($des->pompa_ref_diterima as $pom) {
                    if ($pom) $ref_diterima[] = $pom;
                }
            }
        }
        $ref_diterima = $this->paginate($ref_diterima, 10);
        return view('kecamatan.refocusing.diterima', ['desa' => $desa, 'ref_diterima' => $ref_diterima]);
    }
    public function refDigunakanView() {
        $user = Auth::user();
        $desa = $user->kecamatan ? $user->kecamatan->desa : [];
        $ref_dimanfaatkan = [];
        if ($user->kecamatan) {
            foreach ($user->kecamatan->desa as $des) {
                foreach ($des->pompa_ref_dimanfaatkan as $pom) {
                    if ($pom) $ref_dimanfaatkan[] = $pom;
                }
            }
        }
        $ref_dimanfaatkan = $this->paginate($ref_dimanfaatkan, 10);
        return view('kecamatan.refocusing.digunakan', ['desa' => $desa, 'ref_dimanfaatkan' => $ref_dimanfaatkan]);
    }
    public function refDigunakanDetail($id) {
        $id = Crypt::decryptString($id);
        $ref_dimanfaatkan = PompaRefDimanfaatkan::find($id);
        return view('kecamatan.detailRefocusingDigunakan', ['ref_dimanfaatkan' => $ref_dimanfaatkan]);
    }


    public function abtUsulanView() {
        $user = Auth::user();
        $desa = [];
        $abt_usulan = [];
        if ($user->kecamatan) {
            $desa = $user->kecamatan->desa;
            foreach ($desa as $des) {
                foreach ($des->pompa_abt_usulan as $pom) {
                    if ($pom) $abt_usulan[] = $pom;
                }
            }
        }
        $abt_usulan = $this->paginate($abt_usulan, 10);
        return view('kecamatan.abt.usulan', ['desa' => $desa, 'abt_usulan' => $abt_usulan]);
    }
    public function abtDiterimaView() {
        $user = Auth::user();
        $desa = [];
        $abt_diterima = [];
        if ($user->kecamatan) {
            $desa = $user->kecamatan->desa;
            foreach ($desa as $des) {
                foreach ($des->pompa_abt_diterima as $pom) {
                    if ($pom) $abt_diterima[] = $pom;
                }
            }
        }
        $abt_diterima = $this->paginate($abt_diterima, 10);
        return view('kecamatan.abt.diterima', ['desa' => $desa, 'abt_diterima' => $abt_diterima]);
    }
    public function abtDigunakanView() {
        $user = Auth::user();
        $desa = [];
        $abt_dimanfaatkan = [];
        if ($user->kecamatan) {
            $desa = $user->kecamatan->desa;
            foreach ($desa as $des) {
                foreach ($des->pompa_abt_dimanfaatkan as $pom) {
                    if ($pom) $abt_dimanfaatkan[] = $pom;
                }
            }
        }
        $abt_dimanfaatkan = $this->paginate($abt_dimanfaatkan, 10);
        return view('kecamatan.abt.digunakan', ['desa' => $desa, 'abt_dimanfaatkan' => $abt_dimanfaatkan]);
    }

    public function abtDigunakanDetail($id) {
        $id = Crypt::decryptString($id);
        $abt_dimanfaatkan = PompaAbtDimanfaatkan::find($id);
        return view('kecamatan.detailAbtDigunakan', ['abt_dimanfaatkan' => $abt_dimanfaatkan]);
    }

    //
    public function refocusingUsulan() {
        return view('kecamatan.pompaRefocusingUsulanForm');
    }//

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
