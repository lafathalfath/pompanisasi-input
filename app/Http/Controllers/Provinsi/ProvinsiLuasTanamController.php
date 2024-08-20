<?php

namespace App\Http\Controllers\Provinsi;

use App\Http\Controllers\Controller;
use App\Models\LuasTanam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvinsiLuasTanamController extends Controller
{
    public function index() {
        $user = Auth::user();
        $luas_tanam = [];
        if ($user->provinsi) {
            $desa_id = [];
            foreach ($user->provinsi->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
            $luas_tanam = LuasTanam::whereIn('desa_id', $desa_id)->where('verified_at', '!=', null)->paginate(10);
        }
        // return view
    }
}
