<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use App\Models\Role;
use App\Models\User;
use App\Models\Wilayah;
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
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'email can\'t be null',
            'password.required' => 'password can\'t be null',
        ]);

        $user = null;
        $login_by = 'email';
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $login_by = 'no_hp';
            $user = User::where('no_hp', $request->email)->first();
        }
        if (!$user) return redirect()->route('login')->withErrors('Pengguna tidak ditemukan');
        if (!Hash::check($request->password, $user->password)) return redirect()->route('login')->withErrors('Kata sandi salah!');
        $attempt = Auth::attempt([$login_by=>$request->email, 'password' => $request->password]);
        if (!$attempt) return redirect()->route('login')->withErrors('Email atau kata sandi yang anda masukkan salah!');
        
        $role = Auth::user()->role->nama;
        return redirect()->route("$role.dashboard")->with('success', 'login successfully');
    }

    public function registerView() {
        $role = Role::where('id', '!=', 1)->get();
        return view('auth.register', ['role' => $role]);
    }

    public function register(Request $request) {
        $request->validate([
            'nama' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'no_hp' => 'required|unique:users',
            'role_id' => 'required',
            // 'region_id' => 'required',
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
            'no_hp.unique' => 'no_hp already exist',
            'role_id.required' => 'role cannot be null',
            'region_id.required' => 'region cannot be null',
            'password.required' => 'password cannot be null',
            'password.string' => 'password must be string',
            'password.confirmed' => 'password not match',
        ]);
        // dd($request->region_id);
        $user = User::create([
            ...$request->except(['_token', 'password']),
            'password' => Hash::make($request->password),
        ]);
        if (!$user) return back()->withErrors('account register failed');
        
        Auth::attempt(['email' => $user->email, 'password' => $user->password]);
        $role = $user->role->nama;
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil, Silahkan masuk!');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil logout!');
    }

    public function getAsignee($role_id) {
        $role = $role_id;
        $data_region = [];
        if ($role == 2) $data_region = Wilayah::where('pj_id', null)->get();
        else if ($role == 3) $data_region = Provinsi::where('pj_id', null)->get();
        else if ($role == 4) {
            $data_region = Kabupaten::where('pj_id', null)->get();
            foreach ($data_region as $dr) {
                $dr->nama_provinsi = $dr->provinsi->nama;
            }
        }
        else if ($role == 5) {
            $data_region = Kecamatan::where('pj_id', null)->get();
            foreach ($data_region as $dr) {
                $dr->nama_kabupaten = $dr->kabupaten->nama;
                $dr->nama_provinsi = $dr->kabupaten->provinsi->nama;
            }
        };
        return response()->json(['data' => $data_region]);
    }

    public function waitVerification() {
        return view('auth.waitVerification');
    }

    public function rejectedVerification() {
        return view('auth.rejectedVerification');
    }
}
