<?php

namespace App\Http\Controllers\Nasional;

use App\Http\Controllers\Controller;
use App\Models\PompaRefDimanfaatkan;
use App\Models\PompaRefDiterima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NasionalRefocusingController extends Controller
{
    public function diterima() {
        $user = Auth::user();
        $diterima = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $diterima = PompaRefDiterima::where('verified_at', '!=', null)->paginate(10);
        }
        // return view
    }
    
    public function dimanfaatkan() {
        $user = Auth::user();
        $dimanfaatkan = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $dimanfaatkan = PompaRefDimanfaatkan::where('verified_at', '!=', null)->paginate(10);
        }
        // return view
    }
}
