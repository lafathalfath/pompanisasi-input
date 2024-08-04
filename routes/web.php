<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Kabupaten\KabupatenController;
use App\Http\Controllers\Kecamatan\KecamatanController;
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

Route::get('/kecamatan/pompaAbtUsulanForm', function () {return view('kecamatan.pompaAbtUsulanForm');});
Route::get('/kecamatan/pompaAbtDiterimaForm', function () {return view('kecamatan.pompaAbtDiterimaForm');});
Route::get('/kecamatan/pompaAbtDigunakanForm', function () {return view('kecamatan.pompaAbtDigunakanForm');});
Route::get('/kecamatan/pompaRefocusingUsulanForm', function () {return view('kecamatan.pompaRefocusingUsulanForm');});
Route::get('/kecamatan/pompaRefocusingDiterimaForm', function () {return view('kecamatan.pompaRefocusingDiterimaForm');});
Route::get('/kecamatan/pompaRefocusingDigunakanForm', function () {return view('kecamatan.pompaRefocusingDigunakanForm');});

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
        Route::get('/verifikasi-data', [ProvinsiController::class, 'verifikasiData'])->name('provinsi.verifikasi.data');
    });
    
    Route::prefix('/kabupaten')->middleware('access:kabupaten')->group(function () {
        Route::get('/', function () {return redirect()->route('kabupaten.dashboard');});
        Route::get('/dashboard', [KabupatenController::class, 'index'])->name('kabupaten.dashboard');
        Route::get('/verifikasi-data', [KabupatenController::class, 'verifikasiData'])->name('kabupaten.verifikasi.data');
    });
    
    Route::prefix('/kecamatan')->middleware('access:kecamatan')->group(function () {
        Route::get('/', function () {return redirect()->route('kecamatan.dashboard');});
        Route::get('/dashboard', [KecamatanController::class, 'index'])->name('kecamatan.dashboard');
    });
    
    Route::prefix('/poktan')->middleware('access:poktan')->group(function () {
        Route::get('/', function () {return redirect()->route('poktan.dashboard');});
        Route::get('/dashboard', [PoktanController::class, 'index'])->name('poktan.dashboard');
        Route::get('/inputpompa', [PoktanController::class, 'showForm'])->name('poktan.inputpompa');
        Route::post('/pompa/store', [PoktanController::class, 'storePompa'])->name('poktan.pompa.store');
    });
  
    Route::get('/kabupaten/datacpclkec', function () {
        return view('poktan.datacpclkec');
    });
    
    Route::post('/data-kecamatan', [LokasiController::class, 'storeKecamatan'])->name('lokasi.kecamatan.store');
    Route::post('/data-desa', [LokasiController::class, 'storeDesa'])->name('lokasi.desa.store');
});

