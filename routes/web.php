<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Kabupaten\KabupatenController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\Poktan\PoktanController;
use App\Http\Controllers\Provinsi\ProvinsiController;

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

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.register');
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

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
    
    Route::prefix('/poktan')->middleware('access:poktan')->group(function () {
        Route::get('/', function () {return redirect()->route('poktan.dashboard');});
        Route::get('/dashboard', [PoktanController::class, 'index'])->name('poktan.dashboard');
        Route::get('/inputpompa', [PoktanController::class, 'showForm'])->name('poktan.inputpompa');
        Route::post('/pompa/store', [PoktanController::class, 'storePompa'])->name('poktan.pompa.store');
    });
    Route::post('/kecamatan', [LokasiController::class, 'storeKecamatan'])->name('lokasi.kecamatan.store');
    Route::post('/desa', [LokasiController::class, 'storeDesa'])->name('lokasi.desa.store');
});

