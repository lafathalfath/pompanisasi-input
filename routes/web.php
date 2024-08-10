<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DesaController;
use App\Http\Controllers\Admin\KabupatenController as AdminKabupatenController;
use App\Http\Controllers\Admin\KecamatanController as AdminKecamatanController;
use App\Http\Controllers\Admin\ProvinsiController as AdminProvinsiController;
use App\Http\Controllers\Admin\VerifikasiPjController;
use App\Http\Controllers\Kecamatan\KecamatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Kabupaten\KabupatenController;
use App\Http\Controllers\Kabupaten\KabupatenRefocusingController;
use App\Http\Controllers\Kecamatan\LuasTanamController;
use App\Http\Controllers\Kecamatan\PompaController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\Poktan\PoktanController;
use App\Http\Controllers\Provinsi\ProvinsiController;
use App\Http\Controllers\Wilayah\WilayahController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return redirect()->route('login');});

// Route::get('/kecamatan/inputPompaKecamatan', function () {
//     return view('kecamatan.inputPompaKecamatan');
// });


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.register');
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.login');
    Route::get('/lupa-password', function () {
        return view('auth.forgot-password');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('/admin')->group(function () {
        Route::get('/', function () {return redirect()->route('admin.dashboard');});
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/verifikasi-pj', [VerifikasiPjController::class, 'index'])->name('admin.verifikasiPj');
        Route::put('verifikasi-pj/{user_id}/verifikasi', [VerifikasiPjController::class, 'verifikasi'])->name('admin.verifikasiPj.verifikasi');
        Route::put('verifikasi-pj/{user_id}/tolak', [VerifikasiPjController::class, 'tolak'])->name('admin.verifikasiPj.tolak');
        Route::prefix('/manage')->group(function () {
            Route::get('/provinsi', [AdminProvinsiController::class, 'index'])->name('admin.manage.provinsi');
            Route::post('/provinsi', [AdminProvinsiController::class, 'store'])->name('admin.manage.provinsi.store');
            Route::put('/provinsi/{id}', [AdminProvinsiController::class, 'update'])->name('admin.manage.provinsi.update');
            Route::get('/kabupaten', [AdminKabupatenController::class, 'index'])->name('admin.manage.kabupaten');
            Route::post('/kabupaten', [AdminKabupatenController::class, 'store'])->name('admin.manage.kabupaten.store');
            Route::put('/kabupaten/{id}', [AdminKabupatenController::class, 'update'])->name('admin.manage.kabupaten.update');
            Route::get('/kecamatan', [AdminKecamatanController::class, 'index'])->name('admin.manage.kecamatan');
            Route::post('/kecamatan', [AdminKecamatanController::class, 'store'])->name('admin.manage.kecamatan.store');
            Route::put('/kecamatan/{id}', [AdminKecamatanController::class, 'update'])->name('admin.manage.kecamatan.update');
            Route::get('/desa', [DesaController::class, 'index'])->name('admin.manage.desa');
            Route::post('/desa', [DesaController::class, 'store'])->name('admin.manage.desa.store');
            Route::put('/desa/{id}', [DesaController::class, 'update'])->name('admin.manage.desa.update');
        });
    });

    Route::prefix('/wilayah')->middleware('access:wilayah')->group(function () {
        Route::get('/', function () {return redirect()->route('wilayah.dashboard');});
        Route::get('/dashboard', [WilayahController::class, 'index'])->name('wilayah.dashboard');
        Route::get('/detailprovinsi', function () {
            return view('wilayah.detailProvinsi');
        })->name('wilayah.detailprovinsi');
        Route::prefix('/pompa/refocusing')->group(function () {
            Route::get('/diterima', function () {return view('wilayah.refocusing.diterima');})->name('wilayah.pompa.ref.diterima');
            Route::get('/digunakan', function () {return view('wilayah.refocusing.digunakan');})->name('wilayah.pompa.ref.digunakan');
        });
        Route::prefix('/pompa/abt')->group(function () {
            Route::get('/usulan', function () {return view('wilayah.abt.usulan');})->name('wilayah.pompa.abt.usulan');
            Route::get('/diterima', function () {return view('wilayah.abt.diterima');})->name('wilayah.pompa.abt.diterima');
            Route::get('/digunakan', function () {return view('wilayah.abt.digunakan');})->name('wilayah.pompa.abt.digunakan');
        });
    });

    Route::prefix('/provinsi')->middleware('access:provinsi')->group(function () {
        Route::get('/', function () {return redirect()->route('provinsi.dashboard');});
        Route::get('/dashboard', [ProvinsiController::class, 'index'])->name('provinsi.dashboard');
        Route::get('/detailkabupaten', function () {
            return view('provinsi.detailkabupaten');
        })->name('provinsi.detailkabupaten');
        Route::prefix('/pompa/refocusing')->group(function () {
            Route::get('/diterima', function () {return view('provinsi.refocusing.diterima');})->name('provinsi.pompa.ref.diterima');
            Route::get('/digunakan', function () {return view('provinsi.refocusing.digunakan');})->name('provinsi.pompa.ref.digunakan');
        });
        Route::prefix('/pompa/abt')->group(function () {
            Route::get('/usulan', function () {return view('provinsi.abt.usulan');})->name('provinsi.pompa.abt.usulan');
            Route::get('/diterima', function () {return view('provinsi.abt.diterima');})->name('provinsi.pompa.abt.diterima');
            Route::get('/digunakan', function () {return view('provinsi.abt.digunakan');})->name('provinsi.pompa.abt.digunakan');
        });
    });

    Route::prefix('/kabupaten')->middleware('access:kabupaten')->group(function () {
        Route::get('/', function () {return redirect()->route('kabupaten.dashboard');});
        Route::get('/dashboard', [KabupatenController::class, 'index'])->name('kabupaten.dashboard');
        Route::get('/detailkecamatan', function () {
            return view('kabupaten.detailkecamatan');
        })->name('kabupaten.detailkecamatan');
        Route::get('/verifikasi-data', [KabupatenController::class, 'verifikasiDataView'])->name('kabupaten.verifikasi.data');
        Route::prefix('/pompa/refocusing')->group(function () {
            Route::get('/diterima', [KabupatenRefocusingController::class, 'diterimaView'])->name('kabupaten.pompa.ref.diterima');
            Route::get('/digunakan', [KabupatenRefocusingController::class, 'digunakanView'])->name('kabupaten.pompa.ref.digunakan');
        });
        Route::prefix('/pompa/abt')->group(function () {
            Route::get('/usulan', function () {return view('kabupaten.abt.Usulan');})->name('kabupaten.pompa.abt.usulan');
            Route::get('/diterima', function () {return view('kabupaten.abt.Diterima');})->name('kabupaten.pompa.abt.diterima');
            Route::get('/digunakan', function () {return view('kabupaten.abt.Digunakan');})->name('kabupaten.pompa.abt.digunakan');
        });
    });

    Route::prefix('/kecamatan')->middleware('access:kecamatan')->group(function () {
        Route::get('/', function () {return redirect()->route('kecamatan.dashboard');});
        Route::get('/dashboard', [KecamatanController::class, 'index'])->name('kecamatan.dashboard');

        Route::get('/inputLuasTanam', [LuasTanamController::class, 'index'])->name('kecamatan.inputLuasTanam');
        Route::post('/inputLuasTanam', [LuasTanamController::class, 'store'])->name('kecamatan.inputLuasTanam.store');

        Route::prefix('/pompa/refocusing')->group(function () {
            Route::get('/diterima', [PompaController::class, 'refDiterimaView'])->name('kecamatan.pompa.ref.diterima');
            Route::get('/digunakan', [PompaController::class, 'refDigunakanView'])->name('kecamatan.pompa.ref.digunakan');
            Route::get('/digunakan/{id}/detail', [PompaController::class, 'refDigunakanDetail'])->name('kecamatan.pompa.ref.digunakan.detail');
        });
        Route::prefix('/pompa/abt')->group(function () {
            Route::get('/usulan', [PompaController::class, 'abtUsulanView'])->name('kecamatan.pompa.abt.usulan');
            Route::get('/diterima', [PompaController::class, 'abtDiterimaView'])->name('kecamatan.pompa.abt.diterima');
            Route::get('/digunakan', [PompaController::class, 'abtDigunakanView'])->name('kecamatan.pompa.abt.digunakan');
            Route::get('/digunakan/{id}/detal', [PompaController::class, 'abtDigunakanDetail'])->name('kecamatan.pompa.abt.digunakan.detail');
        });
        Route::prefix('/pompa/refocusing/form')->group(function () {
            Route::get('/diterima', [PompaController::class, 'refocusingDiterima'])->name('kecamatan.refocusing.diterima.input');
            Route::post('/diterima', [KecamatanController::class, 'storeRefocusingDiterima'])->name('kecamatan.refocusing.diterima.store');
            Route::get('/digunakan', [PompaController::class, 'refocusingDigunakan'])->name('kecamatan.refocusing.digunakan.input');
            Route::post('/digunakan', [KecamatanController::class, 'storeRefocusingDigunakan'])->name('kecamatan.refocusing.digunakan.store');
        });
        Route::prefix('/pompa/abt/form')->group(function () {
            Route::get('/usulan', [PompaController::class, 'abtUsulan'])->name('kecamatan.abt.usulan.input');
            Route::post('/usulan', [KecamatanController::class, 'storeAbtUsulan'])->name('kecamatan.abt.usulan.store');
            Route::get('/diterima', [PompaController::class, 'abtDiterima'])->name('kecamatan.abt.diterima.input');
            Route::post('/diterima', [KecamatanController::class, 'storeAbtDiterima'])->name('kecamatan.abt.diterima.store');
            Route::get('/digunakan', [PompaController::class, 'abtDigunakan'])->name('kecamatan.abt.digunakan.input');
            Route::post('/digunakan', [KecamatanController::class, 'storeAbtDigunakan'])->name('kecamatan.abt.digunakan.store');
        });
    });

    
    Route::post('/data-kecamatan', [LokasiController::class, 'storeKecamatan'])->name('lokasi.kecamatan.store');
    Route::post('/data-desa', [LokasiController::class, 'storeDesa'])->name('lokasi.desa.store');
});

// Route::prefix('/poktan')->group(function () {
//     Route::get('/', function () {return redirect()->route('poktan.dashboard');});
//     Route::get('/dashboard', [PoktanController::class, 'index'])->name('poktan.dashboard');
//     Route::get('/inputpompa', [PoktanController::class, 'showForm'])->name('poktan.inputpompa');
//     Route::post('/pompa/store', [PoktanController::class, 'storePompa'])->name('poktan.pompa.store');
// });