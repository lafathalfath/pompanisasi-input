<?php

namespace App\Http\Controllers\Poktan;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class PoktanController extends Controller
{
    public function showForm()
    {
        // dd(Provinsi::find(1)->kabupaten[0]->kecamatan);
        $provinsi = Provinsi::all();
        return view('poktan.inputpompa', compact('provinsi'));
    }
}
