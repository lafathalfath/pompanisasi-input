<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    public function index() {
        $summary = [
            'wilayah' => [
                'ditolak' => User::where('role_id', 2)->where('status_verifikasi', 'ditolak')->count(),
                'proses' => User::where('role_id', 2)->where('status_verifikasi', 'proses')->count(),
                'terverifikasi' => User::where('role_id', 2)->where('status_verifikasi', 'terverifikasi')->count(),
            ],
            'provinsi' => [
                'ditolak' => User::where('role_id', 3)->where('status_verifikasi', 'ditolak')->count(),
                'proses' => User::where('role_id', 3)->where('status_verifikasi', 'proses')->count(),
                'terverifikasi' => User::where('role_id', 3)->where('status_verifikasi', 'terverifikasi')->count(),
            ],
            'kabupaten' => [
                'ditolak' => User::where('role_id', 4)->where('status_verifikasi', 'ditolak')->count(),
                'proses' => User::where('role_id', 4)->where('status_verifikasi', 'proses')->count(),
                'terverifikasi' => User::where('role_id', 4)->where('status_verifikasi', 'terverifikasi')->count(),
            ],
            'kecamatan' => [
                'ditolak' => User::where('role_id', 5)->where('status_verifikasi', 'ditolak')->count(),
                'proses' => User::where('role_id', 5)->where('status_verifikasi', 'proses')->count(),
                'terverifikasi' => User::where('role_id', 5)->where('status_verifikasi', 'terverifikasi')->count(),
            ],
        ];

        return view('admin.dashboard', compact('summary'));
    }
}
