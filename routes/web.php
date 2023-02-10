<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataUmumController;
use App\Http\Controllers\DataUtamaController;
use App\Http\Controllers\JadualController;
use App\Http\Controllers\LaporanKeuangan;
use App\Http\Controllers\LaporanMingguanController;
use App\Http\Controllers\LaporanMingguanKonsultanController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\UserManajemen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('/user-manajement', UserManajemen::class);
    Route::post('/user-manajement/create-admin-uptd', [UserManajemen::class, 'createAdminUptd'])->name('user-manajement.create-admin-uptd');
    Route::post('/user-manajement/update-admin-uptd/{id}', [UserManajemen::class, 'updateAdminUptd'])->name('user-manajement.update-admin-uptd');
    Route::post('/user-manajement/create-admin-konsultan', [UserManajemen::class, 'createUserKonsultan'])->name('user-manajement.create-admin-konsultan');
    Route::post('/user-manajement/update-admin-konsultan/{id}', [UserManajemen::class, 'updateUserKonsultan'])->name('user-manajement.update-admin-konsultan');
    Route::get('/user-manajement/delete-admin-konsultan/{id}', [UserManajemen::class, 'deleteUserKonsultan'])->name('user-manajement.delete-admin-konsultan');
    Route::post('/user-manajement/create-admin-ppk', [UserManajemen::class, 'createUserPpk'])->name('user-manajement.create-admin-ppk');
    Route::post('/user-manajement/update-admin-ppk/{id}', [UserManajemen::class, 'updateUserPpk'])->name('user-manajement.update-admin-ppk');

    Route::resource('data-utama', DataUtamaController::class);
    Route::post('/data-utama/edit-nmp/{id}', [DataUtamaController::class, 'editNmp'])->name('data-utama.edit-nmp');
    Route::get('/data-utama/delete-nmp/{id}', [DataUtamaController::class, 'deleteNmp'])->name('data-utama.delete-nmp');
    Route::post('/data-utama/create-nmp', [DataUtamaController::class, 'createNmp'])->name('data-utama.create-nmp');
    Route::post('/data-utama/edit-kontraktor/{id}', [DataUtamaController::class, 'editKontraktor'])->name('data-utama.edit-kontraktor');
    Route::get('/data-utama/delete-kontraktor/{id}', [DataUtamaController::class, 'deleteKontraktor'])->name('data-utama.delete-kontraktor');
    Route::post('/data-utama/create-kontraktor', [DataUtamaController::class, 'createKontraktor'])->name('data-utama.create-kontraktor');
    Route::post('/data-utama/edit-konsultan/{id}', [DataUtamaController::class, 'editKonsultan'])->name('data-utama.edit-konsultan');
    Route::get('/data-utama/delete-konsultan/{id}', [DataUtamaController::class, 'deleteKonsultan'])->name('data-utama.delete-konsultan');
    Route::post('/data-utama/create-konsultan', [DataUtamaController::class, 'createKonsultan'])->name('data-utama.create-konsultan');

    Route::resource('data-umum', DataUmumController::class);
    Route::get('data-umum/upload/{id}', [DataUmumController::class, 'fileUpload'])->name('upload.dataumum');
    Route::post('/store_file/{id}', [DataUmumController::class, 'store_file'])->name('store.file.dataumum');
    Route::get('/file/{id}/{file}', [DataUmumController::class, 'show_file'])->name('show.file.dataumum');
    Route::put('/adendum/create/{id}', [DataUmumController::class, 'createAdendum'])->name('adendum.create');

    Route::get('/jadual', [JadualController::class, 'index'])->name('jadual.index');
    Route::get('/jadual/create/{id}}', [JadualController::class, 'create'])->name('jadual.create');
    Route::post('/jadual/store/{id}', [JadualController::class, 'store'])->name('jadual.store');
    Route::get('/jadual/edit/{id}', [JadualController::class, 'edit'])->name('jadual.edit');
    Route::put('/jadual/update/{id}', [JadualController::class, 'update'])->name('jadual.update');
    Route::get('/jadual/show/{id}', [JadualController::class, 'show'])->name('jadual.show');
    Route::post('/exceltodata', [JadualController::class, 'exceltodata'])->name('jadual.exceltodata');

    Route::get('/laporan-mingguan-uptd', [LaporanMingguanController::class, 'index'])->name('laporan-mingguan-uptd.index');
    Route::get('/laporan-mingguan-uptd/create/{id}', [LaporanMingguanController::class, 'create'])->name('laporan-mingguan-uptd.create');
    Route::post('/laporan-mingguan-uptd/store/{id}', [LaporanMingguanController::class, 'store'])->name('laporan-mingguan-uptd.store');


    Route::get('/laporan-mingguan-konsultan', [LaporanMingguanKonsultanController::class, 'index'])->name('laporan-mingguan-konsultan.index');
    Route::get('/laporan-mingguan-konsultan/create/{id}', [LaporanMingguanKonsultanController::class, 'create'])->name('laporan-mingguan-konsultan.create');
    Route::post('/laporan-mingguan-konsultan/store/{id}', [LaporanMingguanKonsultanController::class, 'store'])->name('laporan-mingguan-konsultan.store');

    Route::get('laporan-keuangan-create/{id}', [LaporanKeuangan::class, 'create'])->name('laporan-keuangan.create');

    Route::get('/progress-fisik', [ProgressController::class, 'index'])->name('progress-fisik.index');
});
