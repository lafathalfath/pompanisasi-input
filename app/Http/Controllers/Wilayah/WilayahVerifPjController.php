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
            foreach ($me->wilayah->provinsi as $prov) {
                $provinsi[] = $prov->id;
                foreach ($prov->kabupaten as $kab) {
                    $kabupaten[] = $kab->id;
                    foreach ($kab->kecamatan as $kec) $kecamatan[] = $kec->id;
                }
            }
            $user_provinsi = User::where('role_id', 3)->whereIn('region_id', $provinsi)->get();
            $user_kabupaten = User::where('role_id', 4)->whereIn('region_id', $kabupaten)->get();
            $user_kecamatan = User::where('role_id', 5)->whereIn('region_id', $kecamatan)->get();
            foreach ($user_provinsi as $uprov) $uprov->region = Provinsi::find($uprov->region_id);
            foreach ($user_kabupaten as $ukab) $ukab->region = Kabupaten::find($ukab->region_id);
            foreach ($user_kecamatan as $ukec) $ukec->region = Kecamatan::find($ukec->region_id);
            $users = [...$user_provinsi, ...$user_kabupaten, ...$user_kecamatan];
        }
        $users = $this->paginate($users, 10);
        return view('wilayah.verifikasiPj', ['users' => $users]);
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
