<?php

use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-kabupaten/{provinsi_id}', [LocationController::class, 'getKabupaten']);
Route::get('/get-kecamatan/{kabupaten_id}', [LocationController::class, 'getKecamatan']);
Route::get('/get-desa/{kecamatan_id}', [LocationController::class, 'getDesa']);