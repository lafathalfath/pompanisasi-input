<?php

namespace App\Http\Controllers\Nasional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NasionalController extends Controller
{
    public function index() {
        return view('nasional.dashboard');
    }
}
