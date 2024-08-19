<?php

namespace App\Http\Controllers\Wilayah;

use App\Http\Controllers\Controller;
use App\Models\LuasTanam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WilayahLuasTanamController extends Controller
{
    public function index() {
        $user = Auth::user();
        $luas_tanam = [];
        if ($user->wilayah) {
            $desa_id = [];
            foreach ($user->wilayah->provinsi as $prov) foreach ($prov->kabupaten as $kab) foreach ($kab->kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
            $luas_tanam = LuasTanam::whereIn('desa_id', $desa_id)->where('verified_at', '!=', null)->paginate(10);
        }
        // return view
    }
}
