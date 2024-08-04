<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
        ], [
            'email.required' => 'email can\'t be null',
            'email.email' => 'email invalid',
            'password.required' => 'password can\'t be null',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) return redirect()->route('login')->withErrors('cannot found user with this email');
        if (!Hash::check($request->password, $user->password)) return redirect()->route('login')->withErrors('password invalid');
        $attempt = Auth::attempt($request->except('_token'));
        if (!$attempt) return redirect()->route('login')->withErrors('email or password invalid');
        
        $role = Auth::user()->role->nama;
        return redirect()->route("$role.dashboard")->with('success', 'login successfully');
    }

    public function registerView() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'nama' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'no_hp' => 'required',
            // 'role' => 'required',
            'password' => 'required|string|confirmed'
        ], [
            'nama.required' => 'nama cannot be null',
            'nama.string' => 'nama must be string',
            'nama.unique' => 'nama already exist',
            'email.required' => 'email cannot be null',
            'email.string' => 'email must be string',
            'email.email' => 'email invalid',
            'email.unique' => 'email already exist',
            'no_hp.required' => 'no_hp cannot be null',
            // 'role.required' => 'role cannot be null',
            'password.required' => 'password cannot be null',
            'password.string' => 'password must be string',
            'password.confirmed' => 'password not match',
        ]);
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            // 'role' => $request->role,
            'role_id' => 5, // default role poktan. can change by admin
            'password' => Hash::make($request->password),
        ]);
        // dd($user);

        if (!$user) return back()->withErrors('account register failed');
        Auth::attempt(['email' => $user->email, 'password' => $user->password]);
        $role = $user->role->nama;
        // dd($role);
        return redirect()->route("$role.dashboard")->with('success', 'account created');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with('success', 'logout successfully');
    }
}
