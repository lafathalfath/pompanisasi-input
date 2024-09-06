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
use Illuminate\Support\Facades\Crypt;

class VerifikasiPjController extends Controller
{
    public function index(Request $request) {
        $wilayah = [];
        $provinsi = [];
        $kabupaten = [];
        $kecamatan = [];
        $daerah = [];
        $users = [];
        if (Auth::user()->status_verifikasi == 'terverifikasi') {
            $users = User::where('id', '!=', Auth::user()->id);
            if ($request->status) $users = $users->where('status_verifikasi', $request->status);
            if ($request->level) {
                $users = $users->where('role_id', $request->level);
                if ($request->level == '2') $daerah = Wilayah::get();
                elseif ($request->level == '3') $daerah = Provinsi::get();
                elseif ($request->level == '4') $daerah = Kabupaten::get();
                elseif ($request->level == '5') $daerah = Kecamatan::get();
                if ($request->daerah) $users = $users->where('region_id', $request->daerah);
            }
            $users = $users->paginate(10);
            foreach ($users as $us) {
                if ($us->role_id == 2) $us->region = Wilayah::find($us->region_id);
                else if ($us->role_id == 3) $us->region = Provinsi::find($us->region_id);
                else if ($us->role_id == 4) $us->region = Kabupaten::find($us->region_id);
                else if ($us->role_id == 5) $us->region = Kecamatan::find($us->region_id);
            }
        }
        return view('admin.verifikasiPj', ['users' => $users, 'daerah' => $daerah]);
    }

    public function verifikasi($user_id) {
        $user = User::find(Crypt::decryptString($user_id));
        $region = null;
        if ($user->role_id == 2) $region = Wilayah::find($user->region_id);
        else if ($user->role_id == 3) $region = Provinsi::find($user->region_id);
        else if ($user->role_id == 4) $region = Kabupaten::find($user->region_id);
        else if ($user->role_id == 5) $region = Kecamatan::find($user->region_id);
        if ($region) {
            if ($region->pj_id) return back()->withErrors('pj region ini telah di assign');
            $region->update(['pj_id' => $user->id]);
        }
        $user->update(['status_verifikasi' => 'terverifikasi']);
        return back()->with('success', "Berhasil verifikasi: $user->nama");
    }

    public function tolak($user_id) {
        $user = User::find(Crypt::decryptString($user_id));
        // dd($user);
        $user->update(['status_verifikasi' => 'ditolak']);
        return back()->with('success', "Berhasil menolak verifikasi: $user->nama");
    }
}
