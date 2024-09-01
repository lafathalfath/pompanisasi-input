<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $daerah = (object) [
            'wilayah' => Wilayah::count(),
            'provinsi' => Provinsi::count(),
            'kabupaten' => Kabupaten::count(),
            'kecamatan' => Kecamatan::count(),
            'desa' => Desa::count(),
        ];
        $user_role = (object) [
            'admin' => User::where('role_id', 1)->where('status_verifikasi', 'terverifikasi')->count(),
            'nasional' => User::where('role_id', 6)->where('status_verifikasi', 'terverifikasi')->count(),
            'wilayah' => User::where('role_id', 2)->where('status_verifikasi', 'terverifikasi')->count(),
            'provinsi' => User::where('role_id', 3)->where('status_verifikasi', 'terverifikasi')->count(),
            'kabupaten' => User::where('role_id', 4)->where('status_verifikasi', 'terverifikasi')->count(),
            'kecamatan' => User::where('role_id', 5)->where('status_verifikasi', 'terverifikasi')->count(),
        ];
        $user_status = (object) [
            'proses' => User::where('status_verifikasi', 'proses')->count(),
            'terverifikasi' => User::where('status_verifikasi', 'terverifikasi')->count(),
            'ditolak' => User::where('status_verifikasi', 'ditolak')->count(),
        ];
        return view('admin.dashboard', [
            'daerah' => $daerah,
            'user_role' => $user_role,
            'user_status' => $user_status,
        ]);
    }
}
