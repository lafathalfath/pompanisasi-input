<?php

namespace App\Http\Controllers\Wilayah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index() {
        return view('wilayah.dashboard');
    }
}
