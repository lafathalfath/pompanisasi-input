<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiPjController extends Controller
{
    public function index() {
        $users = User::where('role_id', '!=', 1)
            ->where('id', '!=', Auth::user()->id)
            ->get();
        foreach ($users as $us) {
            if ($us->role_id == 2) $us->region = Wilayah::find($us->region_id);
            else if ($us->role_id == 3) $us->region = Provinsi::find($us->region_id);
            else if ($us->role_id == 4) $us->region = Kabupaten::find($us->region_id);
            else if ($us->role_id == 5) $us->region = Kecamatan::find($us->region_id);
        }
        // dd($users);
        return view('admin.verifikasiPj', ['users' => $users]);
    }

    public function verifikasi($user_id) {
        $user = User::find($user_id);
        $region = null;
        if ($user->role_id == 2) $region = Wilayah::find($user->region_id);
        else if ($user->role_id == 3) $region = Provinsi::find($user->region_id);
        else if ($user->role_id == 4) $region = Kabupaten::find($user->region_id);
        else if ($user->role_id == 5) $region = Kecamatan::find($user->region_id);
        if ($region->pj_id) return back()->withErrors('pj region ini telah di assign');
        $region->update(['pj_id' => $user->id]);
        $user->update(['status_verifikasi' => 'terverifikasi']);
        return back()->with('success', "Berhasil verifikasi: $user->nama");
    }

    public function tolak($user_id) {
        $user = User::find($user_id);
        $user->update(['status_verifikasi' => 'ditolak']);
        return back()->with('success', "Berhasil menolak verifikasi: $user->nama");
    }
}
