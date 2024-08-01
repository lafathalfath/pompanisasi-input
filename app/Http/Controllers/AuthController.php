<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
        ], [
            'email.required' => 'email can\'t be null',
            'email.email' => 'email invalid',
            'password.required' => 'password can\'t be null',
        ]);

        if (!Auth::attempt($request->except('_token'))) return abort(403);
        if (Auth::user()->role == 'admin') return redirect()->route('dashboard.admin.index');
    }
}
