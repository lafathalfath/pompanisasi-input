<?php

namespace App\Http\Controllers\Nasional;

use App\Http\Controllers\Controller;
use App\Models\PompaAbtDimanfaatkan;
use App\Models\PompaAbtDiterima;
use App\Models\PompaAbtUsulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NasionalAbtController extends Controller
{
    public function usulan() {
        $user = Auth::user();
        $usulan = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $usulan = PompaAbtUsulan::where('verified_at', '!=', null)->paginate(10);
        }
        // return view
    }
    
    public function diterima() {
        $user = Auth::user();
        $diterima = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $diterima = PompaAbtDiterima::where('verified_at', '!=', null)->paginate(10);
        }
        // return view
    }
    
    public function dimanfaatkan() {
        $user = Auth::user();
        $dimanfaatkan = [];
        if ($user->status_verifikasi == 'terverifikasi') {
            $dimanfaatkan = PompaAbtDimanfaatkan::where('verified_at', '!=', null)->paginate(10);
        }
        // return view
    }
}
