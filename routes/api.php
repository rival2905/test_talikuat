<?php

use App\Http\Controllers\API\PenilaianPenyediaController;
use App\Http\Controllers\API\ProgressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login'])->name('api.login');

Route::group(['middleware' => ['auth.external']], function () {
    Route::post('logout', [\App\Http\Controllers\API\AuthController::class, 'logout'])->name('api.logout');
    Route::get('me', [\App\Http\Controllers\API\AuthController::class, 'me'])->name('api.me');
});

Route::post('get-data-pembangunan-by-uptd', [ProgressController::class, 'getDataPembangunanByUPTD'])->name('get-data-pembangunan-by-uptd');
Route::post('maps-api', [ProgressController::class, 'mapsApi'])->name('maps-api');
Route::get('get-data-pembangunan22', [ProgressController::class, 'getDataPembangunan2022'])->name('get-data-pembangunan22');
Route::get('get-data-curva/{id}', [ProgressController::class, 'getDataPembangunanbyId'])->name('get-data-curva');
Route::get('get-data-progress/{id}', [ProgressController::class, 'getProgressDataById'])->name('get-data-progress');

Route::get('get-data-pembangunan-by-user/{id}', [ProgressController::class, 'getDataPembangunanByUser'])->name('get-data-pembangunan-by-uptd-id');

Route::get('penilaian-penyedia/{id}', [PenilaianPenyediaController::class, 'index'])->name('penilaian-penyedia.index');
Route::post('penilaian-penyedia/store/{id}', [PenilaianPenyediaController::class, 'store'])->name('penilaian-penyedia.store');

Route::get('download-penilaian-penyedia/{id}', [PenilaianPenyediaController::class, 'downloadPenilaianPenyedia'])->name('penilaian-penyedia.download');

Route::get('penilaian-penyedia/get-date-mobilisasi/{id}', [PenilaianPenyediaController::class, 'getDateMobilisasi'])->name('penilaian-penyedia.get-date-mobilisasi');
