<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Kabupaten\KabupatenController;

use function PHPUnit\Framework\returnSelf;

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
    return redirect()->route('login.view');
});

Route::get('/cek', function () {
    $provinsi = Provinsi::get();
    dd($provinsi[0]->kabupaten->pluck('nama'));
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'registerView'])->name('register.view');
    Route::post('/register', [AuthController::class, 'register'])->name('register.register');
    Route::get('/login', [AuthController::class, 'loginView'])->name('login.view');
    Route::post('/login', [AuthController::class, 'login'])->name('login.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('/kabupaten')->group(function () {
        Route::get('/dashboard', [KabupatenController::class, 'index'])->name('kabupaten.dashboard');
        Route::get('/verifikasi-data', [KabupatenController::class, 'verifikasiData'])->name('kabupaten.verifikasi.data');
    });

    Route::prefix('/provinsi')->group(function () {
        Route::get('/dashboard', [ProvinsiController::class, 'index'])->name('provinsi.dashboard');
        Route::get('/verifikasi-data', [ProvinsiController::class, 'verifikasiData'])->name('provinsi.verifikasi.data');
    });
});

<<<<<<< HEAD


Route::get('/poktan/inputpompa', [LocationController::class, 'showForm']);
// Route::get('/get-kabupaten/{provinsi_id}', [LocationController::class, 'getKabupaten']);
// Route::get('/get-kecamatan/{kabupaten_id}', [LocationController::class, 'getKecamatan']);
// Route::get('/get-desa/{kecamatan_id}', [LocationController::class, 'getDesa']);

