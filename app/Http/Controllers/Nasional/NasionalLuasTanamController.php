<?php

namespace App\Http\Controllers\Nasional;

use App\Http\Controllers\Controller;
use App\Models\LuasTanam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NasionalLuasTanamController extends Controller
{
    public function index() {
        $user = Auth::user();
        $luas_tanam = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $luas_tanam = LuasTanam::where('verified_at', '!=', null)->paginate(10);
        }
        // return view
    }
}
