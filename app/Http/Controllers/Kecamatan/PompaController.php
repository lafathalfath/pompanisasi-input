<?php

namespace App\Http\Controllers\Kecamatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PompaController extends Controller
{
    public function refUsulanView() {
        return view('kecamatan.refocusing.usulan');
    }
    public function refDiterimaView() {
        return view('kecamatan.refocusing.diterima');
    }
    public function refDigunakanView() {
        return view('kecamatan.refocusing.digunakan');
    }
    public function abtUsulanView() {
        return view('kecamatan.pompaAbtUsulanForm');
    }
    public function abtDiterimaView() {
        return view('kecamatan.pompaAbtDiterimaForm');
    }
    public function abtDigunakanView() {
        return view('kecamatan.pompaAbtDigunakanForm');
    }
    public function refocusingUsulan() {
        return view('kecamatan.pompaRefocusingUsulanForm');
    }

    public function refocusingDiterima() {
        return view('kecamatan.pompaRefocusingDiterimaForm');
    }
    public function refocusingDigunakan() {
        return view('kecamatan.pompaRefocusingDigunakanForm');
    }
    public function abtUsulan() {
        return view('kecamatan.pompaAbtUsulanForm');
    }
    public function abtDiterima() {
        return view('kecamatan.pompaAbtDiterimaForm');
    }
    public function abtDigunakan() {
        return view('kecamatan.pompaAbtDigunakanForm');
    }
}
