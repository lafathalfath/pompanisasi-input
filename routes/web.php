<?php

use App\Exports\Kecamatan\LuasTanamHarianExport;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DesaController;
use App\Http\Controllers\Admin\KabupatenController as AdminKabupatenController;
use App\Http\Controllers\Admin\KecamatanController as AdminKecamatanController;
use App\Http\Controllers\Admin\ProvinsiController as AdminProvinsiController;
use App\Http\Controllers\Admin\VerifikasiPjController;
use App\Http\Controllers\Kecamatan\KecamatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Kabupaten\KabupatenAbtController;
use App\Http\Controllers\Kabupaten\KabupatenController;
use App\Http\Controllers\Kabupaten\KabupatenRefocusingController;
use App\Http\Controllers\Kecamatan\LuasTanamController;
use App\Http\Controllers\Kecamatan\PompaController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\Nasional\NasionalController;
use App\Http\Controllers\Provinsi\ProvinsiController;
use App\Http\Controllers\Wilayah\WilayahController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Kecamatan\PompaAbtUsulanExport;
use App\Exports\Kecamatan\PompaAbtDiterimaExport;
use App\Exports\Kecamatan\PompaAbtDimanfaatkanExport;
use App\Exports\Kecamatan\PompaRefDiterimaExport;
use App\Exports\Kecamatan\PompaRefDimanfaatkanExport;
use App\Http\Controllers\Admin\ImportStarterController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\StarterPompaKabupatenController;
use App\Http\Controllers\Kabupaten\KabupatenLuasTanamController;
use App\Http\Controllers\Kabupaten\VerifikasiDataController;
use App\Http\Controllers\Nasional\NasionalAbtController;
use App\Http\Controllers\Nasional\NasionalLuasTanamController;
use App\Http\Controllers\Nasional\NasionalRefocusingController;
use App\Http\Controllers\Provinsi\ProvinsiAbtController;
use App\Http\Controllers\Provinsi\ProvinsiLuasTanamController;
use App\Http\Controllers\Provinsi\ProvinsiRefocusingController;
use App\Http\Controllers\Wilayah\WilayahAbtController;
use App\Http\Controllers\Wilayah\WilayahLuasTanamController;
use App\Http\Controllers\Wilayah\WilayahRefocusingController;
use App\Http\Controllers\Wilayah\WilayahVerifPjController;
use App\Models\Desa;
use App\Models\PompaRefDiterima;

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

    Route::get('/waiting-verification', [AuthController::class, 'waitVerification'])->middleware('verify:process')->name('auth.wait.verification');
    Route::get('/rejected-verification', [AuthController::class, 'rejectedVerification'])->middleware('verify:reject')->name('auth.reject.verification');

    Route::prefix('/admin')->middleware('access:admin')->group(function () {
        Route::get('/', function () {return redirect()->route('admin.dashboard');});
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::prefix('/verifikasi-pj')->group(function () {
            Route::get('/', [VerifikasiPjController::class, 'index'])->name('admin.verifikasiPj');
            Route::put('/{user_id}/verifikasi', [VerifikasiPjController::class, 'verifikasi'])->name('admin.verifikasiPj.verifikasi');
            Route::put('/{user_id}/tolak', [VerifikasiPjController::class, 'tolak'])->name('admin.verifikasiPj.tolak');
        });
        Route::prefix('/kelolaAkun')->group(function () {
            Route::get('/', [ManageUserController::class, 'index'])->name('admin.kelolaAkun');
            Route::put('/{id}/update', [ManageUserController::class, 'update'])->name('admin.kelolaAkun.update');
            Route::put('/{id}/nonaktifkan', [ManageUserController::class, 'nonaktifkan'])->name('admin.kelolaAkun.nonaktifkan');
            Route::delete('/delete/{id}', [ManageUserController::class, 'deleteUser'])->name('admin.kelolaAkun.delete');
        });
        Route::prefix('/manage')->group(function () {
            Route::get('/provinsi', [AdminProvinsiController::class, 'index'])->name('admin.manage.provinsi');
            Route::post('/provinsi', [AdminProvinsiController::class, 'store'])->name('admin.manage.provinsi.store');
            Route::put('/provinsi/{id}', [AdminProvinsiController::class, 'update'])->name('admin.manage.provinsi.update');
            Route::delete('/provinsi/{id}', [AdminProvinsiController::class, 'destroy'])->name('admin.manage.provinsi.destroy');
            Route::get('/kabupaten', [AdminKabupatenController::class, 'index'])->name('admin.manage.kabupaten');
            Route::post('/kabupaten', [AdminKabupatenController::class, 'store'])->name('admin.manage.kabupaten.store');
            Route::put('/kabupaten/{id}', [AdminKabupatenController::class, 'update'])->name('admin.manage.kabupaten.update');
            Route::delete('/kabupaten/{id}', [AdminKabupatenController::class, 'destroy'])->name('admin.manage.kabupaten.destroy');
            Route::get('/kecamatan', [AdminKecamatanController::class, 'index'])->name('admin.manage.kecamatan');
            Route::post('/kecamatan', [AdminKecamatanController::class, 'store'])->name('admin.manage.kecamatan.store');
            Route::put('/kecamatan/{id}', [AdminKecamatanController::class, 'update'])->name('admin.manage.kecamatan.update');
            Route::delete('/kecamatan/{id}', [AdminKecamatanController::class, 'destroy'])->name('admin.manage.kecamatan.destroy');
            Route::get('/desa', [DesaController::class, 'index'])->name('admin.manage.desa');
            Route::post('/desa', [DesaController::class, 'store'])->name('admin.manage.desa.store');
            Route::put('/desa/{id}', [DesaController::class, 'update'])->name('admin.manage.desa.update');
            Route::delete('/desa/{id}', [DesaController::class, 'destroy'])->name('admin.manage.desa.destroy');
        });
        Route::prefix('/starter-kabupaten')->group(function () {
            Route::get('/ref_diterima', [StarterPompaKabupatenController::class, 'ref_diterima_view'])->name('admin.starter.kabupaten.ref_diterima');
            Route::post('/ref_diterima', [StarterPompaKabupatenController::class, 'ref_diterima_store'])->name('admin.starter.kabupaten.ref_diterima.store');
            Route::put('/ref_diterima/{id}/update', [StarterPompaKabupatenController::class, 'ref_diterima_update'])->name('admin.starter.kabupaten.ref_diterima.update');
            Route::get('/ref_dimanfaatkan', [StarterPompaKabupatenController::class, 'ref_dimanfaatkan_view'])->name('admin.starter.kabupaten.ref_dimanfaatkan');
            Route::post('/ref_dimanfaatkan', [StarterPompaKabupatenController::class, 'ref_dimanfaatkan_store'])->name('admin.starter.kabupaten.ref_dimanfaatkan.store');
            Route::put('/ref_dimanfaatkan/{id}/update', [StarterPompaKabupatenController::class, 'ref_dimanfaatkan_update'])->name('admin.starter.kabupaten.ref_dimanfaatkan.update');
            Route::get('/abt_usulan', [StarterPompaKabupatenController::class, 'abt_usulan_view'])->name('admin.starter.kabupaten.abt_usulan');
            Route::post('/abt_usulan', [StarterPompaKabupatenController::class, 'abt_usulan_store'])->name('admin.starter.kabupaten.abt_usulan.store');
            Route::put('/abt_usulan/{id}/update', [StarterPompaKabupatenController::class, 'abt_usulan_update'])->name('admin.starter.kabupaten.abt_usulan.update');
            Route::get('/abt_diterima', [StarterPompaKabupatenController::class, 'abt_diterima_view'])->name('admin.starter.kabupaten.abt_diterima');
            Route::post('/abt_diterima', [StarterPompaKabupatenController::class, 'abt_diterima_store'])->name('admin.starter.kabupaten.abt_diterima.store');
            Route::put('/abt_diterima/{id}/update', [StarterPompaKabupatenController::class, 'abt_diterima_update'])->name('admin.starter.kabupaten.abt_diterima.update');
            Route::get('/abt_dimanfaatkan', [StarterPompaKabupatenController::class, 'abt_dimanfaatkan_view'])->name('admin.starter.kabupaten.abt_dimanfaatkan');
            Route::post('/abt_dimanfaatkan', [StarterPompaKabupatenController::class, 'abt_dimanfaatkan_store'])->name('admin.starter.kabupaten.abt_dimanfaatkan.store');
            Route::put('/abt_dimanfaatkan/{id}/update', [StarterPompaKabupatenController::class, 'abt_dimanfaatkan_update'])->name('admin.starter.kabupaten.abt_dimanfaatkan.update');
            Route::get('/luas_tanam', [StarterPompaKabupatenController::class, 'luas_tanam_view'])->name('admin.starter.kabupaten.luas_tanam');
            Route::post('/luas_tanam', [StarterPompaKabupatenController::class, 'luas_tanam_store'])->name('admin.starter.kabupaten.luas_tanam.store');
            Route::put('/luas_tanam/{id}/update', [StarterPompaKabupatenController::class, 'luas_tanam_update'])->name('admin.starter.kabupaten.luas_tanam.update');

            Route::prefix('/import')->group(function () {
                Route::get('/ref_diterima', [ImportStarterController::class, 'ref_diterima_view'])->name('admin.starter.kabupaten.import.ref_diterima.view');
                Route::get('/ref_dimanfaatkan', [ImportStarterController::class, 'ref_dimanfaatkan_view'])->name('admin.starter.kabupaten.import.ref_dimanfaatkan.view');
                Route::get('/abt_usulan', [ImportStarterController::class, 'abt_usulan_view'])->name('admin.starter.kabupaten.import.abt_usulan.view');
                Route::get('/abt_diterima', [ImportStarterController::class, 'abt_diterima_view'])->name('admin.starter.kabupaten.import.abt_diterima.view');
                Route::get('/abt_dimanfaatkan', [ImportStarterController::class, 'abt_dimanfaatkan_view'])->name('admin.starter.kabupaten.import.abt_dimanfaatkan.view');
                Route::get('/luas_tanam', [ImportStarterController::class, 'luas_tanam_view'])->name('admin.starter.kabupaten.import.luas_tanam.view');
                
                Route::post('/ref_diterima/store', [ImportStarterController::class, 'ref_diterima'])->name('admin.starter.kabupaten.import.ref_diterima.store');
                Route::post('/ref_dimanfaatkan/store', [ImportStarterController::class, 'ref_dimanfaatkan'])->name('admin.starter.kabupaten.import.ref_dimanfaatkan.store');
                Route::post('/abt_usulan/store', [ImportStarterController::class, 'abt_usulan'])->name('admin.starter.kabupaten.import.abt_usulan.store');
                Route::post('/abt_diterima/store', [ImportStarterController::class, 'abt_diterima'])->name('admin.starter.kabupaten.import.abt_diterima.store');
                Route::post('/abt_dimanfaatkan/store', [ImportStarterController::class, 'abt_dimanfaatkan'])->name('admin.starter.kabupaten.import.abt_dimanfaatkan.store');
                Route::post('/luas_tanam/store', [ImportStarterController::class, 'luas_tanam'])->name('admin.starter.kabupaten.import.luas_tanam.store');
            });
        });
    });

    Route::prefix('/nasional')->middleware('access:nasional')->group(function () {
        Route::get('/', function () {return redirect()->route('nasional.dashboard');});
        Route::get('/dashboard', [NasionalController::class, 'index'])->name('nasional.dashboard');
        Route::prefix('/pompa/refocusing')->group(function () {
            Route::get('/diterima', [NasionalRefocusingController::class, 'diterima'])->name('nasional.pompa.ref.diterima');
            Route::get('/diterima/{id}/detail', [NasionalRefocusingController::class, 'detailDiterima'])->name('nasional.pompa.ref.diterima.detail');
            Route::get('/digunakan', [NasionalRefocusingController::class, 'dimanfaatkan'])->name('nasional.pompa.ref.digunakan');
            Route::get('/digunakan/{id}/detail', [NasionalRefocusingController::class, 'detailDimanfaatkan'])->name('nasional.pompa.ref.digunakan.detail');
        });
        Route::prefix('/pompa/abt')->group(function () {
            Route::get('/usulan', [NasionalAbtController::class, 'usulan'])->name('nasional.pompa.abt.usulan');
            Route::get('/diterima', [NasionalAbtController::class, 'diterima'])->name('nasional.pompa.abt.diterima');
            Route::get('/diterima/{id}/detail', [NasionalAbtController::class, 'detailDiterima'])->name('nasional.pompa.abt.diterima.detail');
            Route::get('/digunakan', [NasionalAbtController::class, 'dimanfaatkan'])->name('nasional.pompa.abt.digunakan');
            Route::get('/digunakan/{id}/detail', [NasionalAbtController::class, 'detailDimanfaatkan'])->name('nasional.pompa.abt.digunakan.detail');
        });
        Route::get('/luasTanamHarian', [NasionalLuasTanamController::class, 'index'])->name('luasTanamHarianNas');
    });

    Route::prefix('/wilayah')->middleware('access:wilayah')->group(function () {
        Route::get('/', function () {return redirect()->route('wilayah.dashboard');});
        Route::get('/dashboard', [WilayahController::class, 'index'])->name('wilayah.dashboard');
        Route::prefix('/verifikasi-pj')->group(function () {
            Route::get('/', [WilayahVerifPjController::class, 'index'])->name('wilayah.verifikasi.pj');
            Route::put('/{id}/verifikasi', [WilayahVerifPjController::class, 'verifikasi'])->name('wilayah.verifikasi.pj.verif');
            Route::put('/{id}/tolak', [WilayahVerifPjController::class, 'tolak'])->name('wilayah.verifikasi.pj.tolak');
        });
        Route::get('/luasTanamHarian', [WilayahLuasTanamController::class, 'index'])->name('luasTanamHarianWil');
        Route::prefix('/pompa/refocusing')->group(function () {
            Route::get('/diterima', [WilayahRefocusingController::class, 'diterima'])->name('wilayah.pompa.ref.diterima');
            Route::get('/diterima/{id}/detail', [WilayahRefocusingController::class, 'detailDiterima'])->name('wilayah.pompa.ref.diterima.detail');
            Route::get('/digunakan', [WilayahRefocusingController::class, 'dimanfaatkan'])->name('wilayah.pompa.ref.digunakan');
            Route::get('/digunakana/{id}/detail', [WilayahRefocusingController::class, 'detailDimanfaatkan'])->name('wilayah.pompa.ref.digunakan.detail');
        });
        Route::prefix('/pompa/abt')->group(function () {
            Route::get('/usulan', [WilayahAbtController::class, 'usulan'])->name('wilayah.pompa.abt.usulan');
            Route::get('/diterima', [WilayahAbtController::class, 'diterima'])->name('wilayah.pompa.abt.diterima');
            Route::get('/diterima/{id}/detail', [WilayahAbtController::class, 'detailDiterima'])->name('wilayah.pompa.abt.diterima.detail');
            Route::get('/digunakan', [WilayahAbtController::class, 'dimanfaatkan'])->name('wilayah.pompa.abt.digunakan');
            Route::get('/digunakan/{id}/detail', [WilayahAbtController::class, 'detailDimanfaatkan'])->name('wilayah.pompa.abt.digunakan.detail');
        });
    });

    Route::prefix('/provinsi')->middleware('access:provinsi')->group(function () {
        Route::get('/', function () {return redirect()->route('provinsi.dashboard');});
        Route::get('/dashboard', [ProvinsiController::class, 'index'])->name('provinsi.dashboard');
        Route::get('/luasTanamHarian', [ProvinsiLuasTanamController::class, 'index'])->name('luasTanamHarianProv');
        Route::prefix('/pompa/refocusing')->group(function () {
            Route::get('/diterima', [ProvinsiRefocusingController::class, 'diterima'])->name('provinsi.pompa.ref.diterima');
            Route::get('/diterima/{id}/detail', [ProvinsiRefocusingController::class, 'detailDiterima'])->name('provinsi.pompa.ref.diterima.detail');
            Route::get('/digunakan', [ProvinsiRefocusingController::class, 'dimanfaatkan'])->name('provinsi.pompa.ref.digunakan');
            Route::get('/digunakan/{id}/detail', [ProvinsiRefocusingController::class, 'detailDimanfaatkan'])->name('provinsi.pompa.ref.digunakan.detail');
        });
        Route::prefix('/pompa/abt')->group(function () {
            Route::get('/usulan', [ProvinsiAbtController::class, 'usulan'])->name('provinsi.pompa.abt.usulan');
            Route::get('/diterima', [ProvinsiAbtController::class, 'diterima'])->name('provinsi.pompa.abt.diterima');
            Route::get('/diterima/{id}/detail', [ProvinsiAbtController::class, 'detailDiterima'])->name('provinsi.pompa.abt.diterima.detail');
            Route::get('/digunakan', [ProvinsiAbtController::class, 'dimanfaatkan'])->name('provinsi.pompa.abt.digunakan');
            Route::get('/digunakan/{id}/detail', [ProvinsiAbtController::class, 'detailDimanfaatkan'])->name('provinsi.pompa.abt.digunakan.detail');
        });
    });

    Route::prefix('/kabupaten')->middleware('access:kabupaten')->group(function () {
        Route::get('/', function () {return redirect()->route('kabupaten.dashboard');});
        Route::get('/dashboard', [KabupatenController::class, 'index'])->name('kabupaten.dashboard');
        Route::get('/luasTanamHarian', [KabupatenLuasTanamController::class, 'index'])->name('luasTanamHarianKab');
        Route::prefix('/pompa/refocusing')->group(function () {
            Route::get('/diterima', [KabupatenRefocusingController::class, 'diterimaView'])->name('kabupaten.pompa.ref.diterima');
            Route::get('/diterima/{id}/detail', [KabupatenRefocusingController::class, 'detailDiterimaView'])->name('kabupaten.pompa.ref.diterima.detail');
            Route::get('/digunakan', [KabupatenRefocusingController::class, 'digunakanView'])->name('kabupaten.pompa.ref.digunakan');
            Route::get('/digunakan/{id}/detail', [KabupatenRefocusingController::class, 'detailDigunakanView'])->name('kabupaten.pompa.ref.digunakan.detail');
        });
        Route::prefix('/pompa/abt')->group(function () {
            Route::get('/usulan', [KabupatenAbtController::class, 'usulanView'])->name('kabupaten.pompa.abt.usulan');
            Route::get('/diterima', [KabupatenAbtController::class, 'diterimaView'])->name('kabupaten.pompa.abt.diterima');
            Route::get('/diterima/{id}/detail', [KabupatenAbtController::class, 'detailDiterimaView'])->name('kabupaten.pompa.abt.diterima.detail');
            Route::get('/digunakan', [KabupatenAbtController::class, 'digunakanView'])->name('kabupaten.pompa.abt.digunakan');
            Route::get('/digunakan/{id}/detail', [KabupatenAbtController::class, 'detailDigunakanView'])->name('kabupaten.pompa.abt.digunakan.detail');
        });
        Route::prefix('/verifikasi')->group(function () {
            Route::get('/refocusing/diterima', [VerifikasiDataController::class, 'refDiterimaView'])->name('kabupaten.verif.ref.diterima.view');
            Route::put('/refocusing/diterima/{id}', [VerifikasiDataController::class, 'refDiterimaVerif'])->name('kabupaten.verif.ref.diterima.verif');
            Route::get('/refocusing/digunakan', [VerifikasiDataController::class, 'refDimanfaatkanView'])->name('kabupaten.verif.ref.digunakan.view');
            Route::put('/refocusing/digunakan/{id}', [VerifikasiDataController::class, 'refDimanfaatkanVerif'])->name('kabupaten.verif.ref.digunakan.verif');
            Route::get('/abt/usulan', [VerifikasiDataController::class, 'abtUsulanView'])->name('kabupaten.verif.abt.usulan.view');
            Route::put('/abt/usulan/{id}', [VerifikasiDataController::class, 'abtUsulanVerif'])->name('kabupaten.verif.abt.usulan.verif');
            Route::get('/abt/diterima', [VerifikasiDataController::class, 'abtDiterimaView'])->name('kabupaten.verif.abt.diterima.view');
            Route::put('/abt/diterima/{id}', [VerifikasiDataController::class, 'abtDiterimaVerif'])->name('kabupaten.verif.abt.diterima.verif');
            Route::get('/abt/digunakan', [VerifikasiDataController::class, 'abtDimanfaatkanView'])->name('kabupaten.verif.abt.digunakan.view');
            Route::put('/abt/digunakan/{id}', [VerifikasiDataController::class, 'abtDimanfaatkanVerif'])->name('kabupaten.verif.abt.digunakan.verif');
            Route::get('/luas-tanam', [VerifikasiDataController::class, 'luasTanamView'])->name('kabupaten.verif.luasTanam.view');
            Route::put('/luas-tanam/{id}', [VerifikasiDataController::class, 'luasTanamVerif'])->name('kabupaten.verif.luasTanam.verif');
        });
        Route::prefix('/unverified')->group(function () {
            Route::put('/refocusing/diterima/{id}', [VerifikasiDataController::class, 'refDiterimaUnverif'])->name('kabupaten.verif.ref.diterima.unverif');
            Route::put('/refocusing/digunakan/{id}', [VerifikasiDataController::class, 'refDimanfaatkanUnverif'])->name('kabupaten.verif.ref.digunakan.unverif');
            Route::put('/abt/usulan/{id}', [VerifikasiDataController::class, 'abtUsulanUnverif'])->name('kabupaten.verif.abt.usulan.unverif');
            Route::put('/abt/diterima/{id}', [VerifikasiDataController::class, 'abtDiterimaUnverif'])->name('kabupaten.verif.abt.diterima.unverif');
            Route::put('/abt/digunakan/{id}', [VerifikasiDataController::class, 'abtDimanfaatkanUnverif'])->name('kabupaten.verif.abt.digunakan.unverif');
            Route::put('/luas-tanam/{id}', [VerifikasiDataController::class, 'luasTanamUnverif'])->name('kabupaten.verif.luasTanam.unverif');
        });
    });

    Route::prefix('/kecamatan')->middleware('access:kecamatan')->group(function () {
        Route::get('/', function () {return redirect()->route('kecamatan.dashboard');});
        Route::get('/dashboard', [KecamatanController::class, 'index'])->name('kecamatan.dashboard');

        Route::get('/luasTanamHarian', [LuasTanamController::class, 'index'])->name('luasTanamHarianKec');
        Route::get('/inputLuasTanam', [LuasTanamController::class, 'create'])->name('kecamatan.inputLuasTanam');
        Route::post('/inputLuasTanam', [LuasTanamController::class, 'store'])->name('kecamatan.inputLuasTanam.store');

        Route::prefix('/pompa/refocusing')->group(function () {
            Route::get('/diterima', [PompaController::class, 'refDiterimaView'])->name('kecamatan.pompa.ref.diterima');
            Route::get('/digunakan', [PompaController::class, 'refDigunakanView'])->name('kecamatan.pompa.ref.digunakan');
            Route::get('/diterima/{id}/detail', [PompaController::class, 'refDiterimaDetail'])->name('kecamatan.pompa.ref.diterima.detail');
            Route::get('/digunakan/{id}/detail', [PompaController::class, 'refDigunakanDetail'])->name('kecamatan.pompa.ref.digunakan.detail');
        });
        Route::prefix('/pompa/abt')->group(function () {
            Route::get('/usulan', [PompaController::class, 'abtUsulanView'])->name('kecamatan.pompa.abt.usulan');
            Route::get('/diterima', [PompaController::class, 'abtDiterimaView'])->name('kecamatan.pompa.abt.diterima');
            Route::get('/digunakan', [PompaController::class, 'abtDigunakanView'])->name('kecamatan.pompa.abt.digunakan');
            Route::get('/diterima/{id}/detal', [PompaController::class, 'abtDiterimaDetail'])->name('kecamatan.pompa.abt.diterima.detail');
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
    
    // Route Export Pompa ABT & Ref all role
    Route::get('/export-pompa-abt-usulan', function () {
        return Excel::download(new PompaAbtUsulanExport, 'Usulan Pompa ABT.xlsx');
    });
    Route::get('/export-pompa-abt-diterima', function () {
        return Excel::download(new PompaAbtDiterimaExport, 'Pompa ABT Diterima.xlsx');
    });
    Route::get('/export-pompa-abt-dimanfaatkan', function () {
        return Excel::download(new PompaAbtDimanfaatkanExport, 'Pompa ABT Dimanfaatkan.xlsx');
    });
    Route::get('/export-pompa-ref-diterima', function () {
        return Excel::download(new PompaRefDiterimaExport, 'Pompa Refocusing Diterima.xlsx');
    });
    Route::get('/export-pompa-ref-dimanfaatkan', function () {
        return Excel::download(new PompaRefDimanfaatkanExport, 'Pompa Refocusing Dimanfaatkan.xlsx');
    });
    Route::get('/export-luas-tanam-harian', function () {return Excel::download(new LuasTanamHarianExport, 'Luas Tanam Harian.xlsx');})->name('export.luasTanamHarian');

});