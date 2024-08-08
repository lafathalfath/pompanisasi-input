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
        if (!$user) return redirect()->route('login')->withErrors('cannot found user with this email');
        if (!Hash::check($request->password, $user->password)) return redirect()->route('login')->withErrors('password invalid');
        $attempt = Auth::attempt([$login_by=>$request->email, 'password' => $request->password]);
        if (!$attempt) return redirect()->route('login')->withErrors('email or password invalid');
        
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
            'region_id' => 'required',
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
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'role_id' => $request->role_id, // default role poktan. can change by admin
            'region_id' => $request->region_id,
            'password' => Hash::make($request->password),
        ]);
        // dd($user);
        if (!$user) return back()->withErrors('account register failed');
        // $region = null;

        // if ($user->role_id == 2) $region = Wilayah::find($request->region_id);
        // else if ($user->role_id == 3) $region = Provinsi::find($request->region_id);
        // else if ($user->role_id == 4) $region = Kabupaten::find($request->region_id);
        // else if ($user->role_id == 5) $region = Kecamatan::find($request->region_id);
        // if (!$region) return back()->withErrors('region invalid');
        // $region->update(['pj_id' => $user->id]);

        Auth::attempt(['email' => $user->email, 'password' => $user->password]);
        $role = $user->role->nama;
        // dd($role);
        return redirect()->route("$role.dashboard")->with('success', 'account created');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with('success', 'logout successfully');
    }

    public function getAsignee($role_id) {
        $role = $role_id;
        $data_region = [];
        if ($role == 2) $data_region = Wilayah::get();
        else if ($role == 3) $data_region = Provinsi::get();
        else if ($role == 4) {
            $data_region = Kabupaten::get();
            foreach ($data_region as $dr) {
                $dr->nama_provinsi = $dr->provinsi->nama;
            }
        }
        else if ($role == 5) {
            $data_region = Kecamatan::get();
            foreach ($data_region as $dr) {
                $dr->nama_kabupaten = $dr->kabupaten->nama;
                $dr->nama_provinsi = $dr->kabupaten->provinsi->nama;
            }
        };
        return response()->json(['data' => $data_region]);
    }
}
