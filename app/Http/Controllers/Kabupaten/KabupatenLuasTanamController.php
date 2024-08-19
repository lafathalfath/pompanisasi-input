<?php

namespace App\Http\Controllers\Kabupaten;

use App\Http\Controllers\Controller;
use App\Models\LuasTanam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KabupatenLuasTanamController extends Controller
{
    public function index() {
        $user = Auth::user();
        $luas_tanam = [];
        if ($user->kabupaten) {
            $desa_id = [];
            foreach ($user->kabupaten->kecamatan as $kec) foreach ($kec->desa as $des) $desa_id[] = $des->id;
            $luas_tanam = LuasTanam::whereIn('desa_id', $desa_id)->where('verified_at', '!=', null)->paginate(10);
        }
        // return view
    }
}
