<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Kabupaten\KabupatenController;
use App\Http\Controllers\Kecamatan\KecamatanController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/kecamatan/inputPompaKecamatan', function () {
    return view('kecamatan.inputPompaKecamatan');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.register');
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('/wilayah')->group(function () {
        Route::get('/', function () {return redirect()->route('wilayah.dashboard');});
        Route::get('/dashboard', [WilayahController::class, 'index'])->name('wilaya.dashboard');
    });

    Route::prefix('/provinsi')->middleware('access:provinsi')->group(function () {
        Route::get('/', function () {return redirect()->route('provinsi.dashboard');});
        Route::get('/dashboard', [ProvinsiController::class, 'index'])->name('provinsi.dashboard');
        Route::get('/detailkabupaten', function () {
            return view('provinsi.detailkabupaten');
        })->name('provinsi.detailkabupaten');
        Route::get('/verifikasi-data', [ProvinsiController::class, 'verifikasiData'])->name('provinsi.verifikasi.data');
    });
    
    Route::prefix('/kabupaten')->middleware('access:kabupaten')->group(function () {
        Route::get('/', function () {return redirect()->route('kabupaten.dashboard');});
        Route::get('/dashboard', [KabupatenController::class, 'index'])->name('kabupaten.dashboard');
        Route::get('/detailkecamatan', function () {
            return view('kabupaten.detailkecamatan');
        })->name('kabupaten.detailkecamatan');
        Route::get('/verifikasi-data', [KabupatenController::class, 'verifikasiDataView'])->name('kabupaten.verifikasi.data');
    });
    
    Route::prefix('/kecamatan')->middleware('access:kecamatan')->group(function () {
        Route::get('/', function () {return redirect()->route('kecamatan.dashboard');});
        Route::get('/dashboard', [KecamatanController::class, 'index'])->name('kecamatan.dashboard');
        Route::get('/detaildesa', function () {
            return view('kecamatan.detaildesa');
        });
        
        Route::get('/inputLuasTanam', function () {
            return view('kecamatan.inputLuasTanam');
        })->name('kecamatan.inputLuasTanam');

        Route::prefix('/pompa/refocusing')->group(function () {
            Route::get('/usulan', [PompaController::class, 'refUsulanView'])->name('kecamatan.pompa.ref.usulan');
            Route::get('/diterima', [PompaController::class, 'refDiterimaView'])->name('kecamatan.pompa.ref.diterima');
            Route::get('/digunakan', [PompaController::class, 'refDigunakanView'])->name('kecamatan.pompa.ref.digunakan');
        });
        Route::prefix('/pompa/abt')->group(function () {
            Route::get('/usulan', [PompaController::class, 'abtUsulanView'])->name('kecamatan.pompa.abt.usulan');
            Route::get('/diterima', [PompaController::class, 'abtDiterimaView'])->name('kecamatan.pompa.abt.diterima');
            Route::get('/digunakan', [PompaController::class, 'abtDigunakanView'])->name('kecamatan.pompa.abt.digunakan');
        });
        Route::prefix('/pompa/refocusing/form')->group(function () {
            Route::get('/usulan', [PompaController::class, 'refocusingUsulan'])->name('kecamatan.refocusing.usulan.input');
            Route::post('/usulan', [KecamatanController::class, 'storeRefocusingUsulan'])->name('kecamatan.refocusing.usulan.store');
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
    
    Route::prefix('/poktan')->middleware('access:poktan')->group(function () {
        Route::get('/', function () {return redirect()->route('poktan.dashboard');});
        Route::get('/dashboard', [PoktanController::class, 'index'])->name('poktan.dashboard');
        Route::get('/inputpompa', [PoktanController::class, 'showForm'])->name('poktan.inputpompa');
        Route::post('/pompa/store', [PoktanController::class, 'storePompa'])->name('poktan.pompa.store');
    });
    
    Route::post('/data-kecamatan', [LokasiController::class, 'storeKecamatan'])->name('lokasi.kecamatan.store');
    Route::post('/data-desa', [LokasiController::class, 'storeDesa'])->name('lokasi.desa.store');
});

