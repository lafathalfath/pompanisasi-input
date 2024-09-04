<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use App\Models\Role;
use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ManageUserController extends Controller
{
    public function index(Request $request) {
        $users = User::where('id', '!=', Auth::user()->id);
        if ($request->status) $users = $users->where('status_verifikasi', $request->status);
        if ($request->role) $users = $users->where('role_id', $request->role);
        $users = $users->paginate(10);
        $role = Role::get();
        return view('admin.kelolaAkun', [
            'users' => $users,
            'role' => $role,
        ]);
    }

    public function update($id, Request $request) {
        $user = User::find(Crypt::decryptString($id));
        if (!$user) return back()->withErrors('user tidak ditemukan');
        $request->validate([
            'role_id' => 'required',
        ], [
            'role_id.required' => 'tidak ada role',
        ]);
        if ($user->region_id) {
            $region = null;
            if ($user->role_id == 2) $region = Wilayah::find($user->region_id);
            elseif ($user->role_id == 3) $region = Provinsi::find($user->region_id);
            elseif ($user->role_id == 4) $region = Kabupaten::find($user->region_id);
            elseif ($user->role_id == 5) $region = Kecamatan::find($user->region_id);
            if ($region) {
                $region->update(['pj_id' => null]);
                $user->update(['region_id' => null]);
            }
        }
        if ($request->role_id == 1 || $request->role_id == 6) {
            $user->update(['role_id' => $request->role_id]);
        } elseif ($request->region_id) {
            $region_after = null;
            if ($request->role_id == 2) $region_after = Wilayah::find($request->region_id);
            elseif ($request->role_id == 3) $region_after = Provinsi::find($request->region_id);
            elseif ($request->role_id == 4) $region_after = Kabupaten::find($request->region_id);
            elseif ($request->role_id == 5) $region_after = Kecamatan::find($request->region_id);
            if ($region_after) {
                if ($region_after->pj_id) return back()->withErrors('region sudah memiliki pj');
                $region_after->update(['pj_id' => $user->id]);
                if ($region_after) $user->update([
                    'role_id' => $request->role_id,
                    'region_id' => $region_after->id,
                    'status_verifikasi' => 'terverifikasi',
                ]);
            }
        } else {
            return back()->withErrors('terjadi kesalahan input');
        }
        return back()->with('success', 'berhasil mengupdate data user');
    }

    public function deleteUser($id)
        {
            $userId = Crypt::decryptString($id);
            $user = User::findOrFail($userId);

            if ($user) {
                if ($user->role_id == 2) { 
                    Wilayah::where('pj_id', $user->id)->update(['pj_id' => null]);
                } elseif ($user->role_id == 3) {
                    Provinsi::where('pj_id', $user->id)->update(['pj_id' => null]);
                } elseif ($user->role_id == 4) { 
                    Kabupaten::where('pj_id', $user->id)->update(['pj_id' => null]);
                } elseif ($user->role_id == 5) {
                    Kecamatan::where('pj_id', $user->id)->update(['pj_id' => null]);
                }

                $user->delete();

                return redirect()->route('admin.kelolaAkun')->with('success', 'Akun berhasil dihapus');
            } else {
                return redirect()->route('admin.kelolaAkun')->with('error', 'Akun tidak ditemukan');
            }
        }

    public function nonaktifkan($id) {
        $user = User::find(Crypt::decryptString($id));
        if (!$user) return back()->withErrors('user tidak ditemukan');
        if ($user->status_verifikasi == 'proses') return back()->withErrors('tidak dapat menonaktifkan, akun user tidak aktif');
        if (!$user->region_id) {
            $user->update(['status_verifikasi' => 'proses']);
        } else {
            $region = null;
            if ($user->role_id == 2) $region = Wilayah::find($user->region_id);
            elseif ($user->role_id == 3) $region = Provinsi::find($user->region_id);
            elseif ($user->role_id == 4) $region = Kabupaten::find($user->region_id);
            elseif ($user->role_id == 5) $region = Kecamatan::find($user->region_id);
            if ($region) {
                $region->update(['pj_id' => null]);
            }
            $user->update(['status_verifikasi' => 'proses']);
        }
        return back()->with('success', 'berhasil mengnonaktifkan user');
    }

}
