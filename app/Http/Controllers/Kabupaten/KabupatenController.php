<?php

namespace App\Http\Controllers\Kabupaten;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KabupatenController extends Controller
{
    public function index() {
        $user = Auth::user();
        if (!$user) return redirect()->route('login.view')->withErrors('unauthorized');
        $kabupaten = $user->kabupaten;
        return view('kabupaten.dashboard', [
            'kabupaten' => $kabupaten,
        ]);
    }
}
