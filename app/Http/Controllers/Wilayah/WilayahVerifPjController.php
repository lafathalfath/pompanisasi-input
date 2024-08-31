<?php

namespace App\Http\Controllers\Wilayah;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use App\Models\User;
use App\Traits\ArrayPaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class WilayahVerifPjController extends Controller
{

    use ArrayPaginator;

    public function index(Request $request) {
        $me = Auth::user();
        $users = [];
        if ($me->wilayah) {
            $provinsi = [];
            $kabupaten = [];
            $kecamatan = [];
            $daerah = [];
            foreach ($me->wilayah->provinsi as $prov) {
                $provinsi[] = $prov->id;
                foreach ($prov->kabupaten as $kab) {
                    $kabupaten[] = $kab->id;
                    foreach ($kab->kecamatan as $kec) $kecamatan[] = $kec->id;
                }
            }
            $users = User::whereIn('region_id', [...$provinsi, ...$kabupaten, ...$kecamatan]);
            if ($request->status) $users = $users->where('status_verifikasi', $request->status);
            if ($request->level) {
                $users = $users->where('role_id', $request->level);
                if ($request->level == 3) $daerah = Provinsi::whereIn('id', $provinsi)->get();
                elseif ($request->level == 4) $daerah = Kabupaten::whereIn('id', $kabupaten)->get();
                elseif ($request->level == 5) $daerah = Kecamatan::whereIn('id', $kecamatan)->get();
                if ($request->daerah) $users = $users->where('region_id', $request->daerah);
            }
            $users = $users->get();
            foreach ($users as $user) {
                if ($user->role_id == 3) $user->region = Provinsi::find($user->region_id);
                if ($user->role_id == 4) $user->region = Kabupaten::find($user->region_id);
                if ($user->role_id == 5) $user->region = Kecamatan::find($user->region_id);
            }
        }
        $users = $this->paginate($users, 10);
        return view('wilayah.verifikasiPj', ['users' => $users, 'daerah' => $daerah]);
    }

    public function verifikasi($id) {
        $user = User::find(Crypt::decryptString($id));
        $region = null;
        if ($user->role_id == 3) {
            $provinsi = Provinsi::find($user->region_id);
            $region = !$provinsi->pj_id ? $provinsi : $region;
        } elseif ($user->role_id == 4) {
            $kabupaten = Kabupaten::find($user->region_id);
            $region = !$kabupaten->pj_id ? $kabupaten : $region;
        } elseif ($user->role_id == 5) {
            $kecamatan = Kecamatan::find($user->region_id);
            $region = !$kecamatan->pj_id ? $kecamatan : $region;
        }
        if (!$region) return back()->withErrors('penanggungjawab pada region ini telah di assign');
        $region->update(['pj_id' => $user->id]);
        $user->update(['status_verifikasi' => 'terverifikasi']);
        return back()->with('success', 'berhasil melakukan verifikasi akun');
    }

    public function tolak($id) {
        $user = User::find(Crypt::decryptString($id));
        $user->update(['status_verifikasi' => 'ditolak']);
        return back()->with('success', 'berhasil melakukan penolakan verifikasi akun');
    }
}
