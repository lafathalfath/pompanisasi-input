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

    Route::prefix('/admin')->middleware('access:admin')->group(function () {
        Route::get('/', function () {return redirect()->route('admin.dashboard');});
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/verifikasi-pj', [VerifikasiPjController::class, 'index'])->name('admin.verifikasiPj');
        Route::put('verifikasi-pj/{user_id}/verifikasi', [VerifikasiPjController::class, 'verifikasi'])->name('admin.verifikasiPj.verifikasi');
        Route::put('verifikasi-pj/{user_id}/tolak', [VerifikasiPjController::class, 'tolak'])->name('admin.verifikasiPj.tolak');
        Route::get('/kelolaAkun', function () {
            return view('admin.kelolaAkun');
        })->name('admin.kelolaAkun');
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

    Route::get('/verifAdmin', function () {
        return view('admin.verifikasiData');
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