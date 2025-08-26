<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CurvaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataUmumController;
use App\Http\Controllers\DataUtamaController;
use App\Http\Controllers\JadualController;
use App\Http\Controllers\LaporanBulananKonsultanController;
use App\Http\Controllers\LaporanBulananUptd;
use App\Http\Controllers\LaporanBulananUptdController;
use App\Http\Controllers\LaporanKeuangan;
use App\Http\Controllers\LaporanMingguanController;
use App\Http\Controllers\LaporanKonsultan;
use App\Http\Controllers\PenilaianPenyediaController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\UserManajemen;
use App\Http\Controllers\UtilsController;
use App\Http\Controllers\DocumentCategoryController;
use App\Http\Controllers\DataUmumDocumentCategoryController;

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
    Route::post('/user-manajement/set-role', [UserManajemen::class, 'setRole'])->name('user-manajement.set-role');
    Route::get('/user-manajement/set-role', [UserManajemen::class, 'pageSetRole'])->name('user-manajement.set-role-page');
});

Route::middleware(['auth.external'])->group(function () {
    Route::get('/dashboard-konsultan', [DashboardController::class, 'index'])->name('dashboard-external');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/laporan-mingguan-konsultan-external', [LaporanKonsultan::class, 'index'])->name('laporan-mingguan-konsultan-external.index');
    Route::get('/laporan-mingguan-konsultan-external/create/{id}', [LaporanKonsultan::class, 'create'])->name('laporan-mingguan-konsultan-external.create');
    Route::post('/laporan-mingguan-konsultan-external/store/{id}', [LaporanKonsultan::class, 'store'])->name('laporan-mingguan-konsultan-external.store');

    Route::get('/laporan-bulanan-konsultan-external', [LaporanBulananKonsultanController::class, 'index'])->name('laporan-bulanan-konsultan-external.index');
    Route::get('/laporan-bulanan-konsultan-external/create/{id}', [LaporanBulananKonsultanController::class, 'create'])->name('laporan-bulanan-konsultan-external.create');
    Route::post('/laporan-bulanan-konsultan-external/store/{id}', [LaporanBulananKonsultanController::class, 'store'])->name('laporan-bulanan-konsultan-external.store');
});

Route::middleware(['auth', 'userVerified'])->group(function () {
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
    Route::get('/user-manajement/delete-admin-ppk/{id}', [UserManajemen::class, 'deleteUserPpk'])->name('user-manajement.delete-admin-ppk');



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
    Route::get('data-umum/data/{thn}', [DataUmumController::class, 'index'])->name('data-umum.index');
    Route::get('data-umum/upload/{id}', [DataUmumController::class, 'fileUpload'])->name('upload.dataumum');
    Route::get('data-umum/deletefile/{id}/{fileName}', [DataUmumController::class, 'deletefile'])->name('deletefile.dataumum');
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
    Route::post('/laporan-mingguan-uptd/approval/{id}', [LaporanMingguanController::class, 'approval'])->name('laporan-mingguan-uptd.approval');
    Route::get('/laporan-mingguan-uptd/edit/{id}', [LaporanMingguanController::class, 'edit'])->name('laporan-mingguan-uptd.edit');
    Route::put('/laporan-mingguan-uptd/update/{id}', [LaporanMingguanController::class, 'update'])->name('laporan-mingguan-uptd.update');

    Route::get('/laporan-bulanan-uptd', [LaporanBulananUptdController::class, 'index'])->name('laporan-bulanan-uptd.index');
    Route::get('/laporan-bulanan-uptd/create/{id}', [LaporanBulananUptdController::class, 'create'])->name('laporan-bulanan-uptd.create');
    Route::post('/laporan-bulanan-uptd/store/{id}', [LaporanBulananUptdController::class, 'store'])->name('laporan-bulanan-uptd.store');
    Route::post('/laporan-bulanan-uptd/approval/{id}', [LaporanBulananUptdController::class, 'approval'])->name('laporan-bulanan-uptd.approval');
    Route::get('/laporan-bulanan-uptd/edit/{id}', [LaporanBulananUptdController::class, 'edit'])->name('laporan-bulanan-uptd.edit');
    Route::put('/laporan-bulanan-uptd/update/{id}', [LaporanBulananUptdController::class, 'update'])->name('laporan-bulanan-uptd.update');

    Route::get('/laporan-mingguan-konsultan', [LaporanKonsultan::class, 'index'])->name('laporan-mingguan-konsultan.index');
    Route::get('/laporan-mingguan-konsultan/create/{id}', [LaporanKonsultan::class, 'create'])->name('laporan-mingguan-konsultan.create');
    Route::post('/laporan-mingguan-konsultan/store/{id}', [LaporanKonsultan::class, 'store'])->name('laporan-mingguan-konsultan.store');

    Route::get('/laporan-bulanan-konsultan', [LaporanBulananKonsultanController::class, 'index'])->name('laporan-bulanan-konsultan.index');
    Route::get('/laporan-bulanan-konsultan/create/{id}', [LaporanBulananKonsultanController::class, 'create'])->name('laporan-bulanan-konsultan.create');
    Route::post('/laporan-bulanan-konsultan/store/{id}', [LaporanBulananKonsultanController::class, 'store'])->name('laporan-bulanan-konsultan.store');

    Route::get('laporan-keuangan}', [LaporanKeuangan::class, 'index'])->name('laporan-keuangan.index');
    Route::get('laporan-keuangan-create/{id}', [LaporanKeuangan::class, 'create'])->name('laporan-keuangan.create');

    Route::get('/progress-fisik', [ProgressController::class, 'index'])->name('progress-fisik.index');

    Route::get('/curva-s/{id}', [CurvaController::class, 'index'])->name('curva-s.index');

    Route::get('/download-template-jadual/{data_umum}', [JadualController::class, 'downloadTemplate'])->name('jadual.downloadTemplate');

    Route::get('/download-template-laporan-mingguan/{data_umum}', [LaporanMingguanController::class, 'downloadTemplate'])->name('laporan-mingguan-uptd.downloadTemplate');

    Route::get('/progress-all', [UtilsController::class, 'progressAll'])->name('progress-all.index');
    Route::get('/progress/{uptd}', [UtilsController::class, 'progressUptd'])->name('progress-all.filter');
    Route::get('/rekap-dokumen/{uptd}', [UtilsController::class, 'rekapDokumen'])->name('rekap-dokumen.index');

    Route::get('/penilaian-penyedia/{id}', [PenilaianPenyediaController::class, 'index'])->name('penilaian-penyedia.index');
    Route::get('/penilaian-penyedia/create/{id}', [PenilaianPenyediaController::class, 'create'])->name('penilaian-penyedia.create');
    Route::post('/penilaian-penyedia/store/{id}', [PenilaianPenyediaController::class, 'store'])->name('penilaian-penyedia.store');
    Route::get('/penilaian-penyedia/show/{id}', [PenilaianPenyediaController::class, 'show'])->name('penilaian-penyedia.show');

    // Document Category
    Route::prefix('document-category')->group(function () {
        Route::get('/', [DocumentCategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/create', [DocumentCategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/store', [DocumentCategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/edit/{id}', [DocumentCategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('/update/{id}', [DocumentCategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('/destroy/{id}', [DocumentCategoryController::class, 'destroy'])->name('admin.category.destroy');
    });
    Route::prefix('data-umum')->group(function () {
        Route::get('document-category/{id}', [DataUmumDocumentCategoryController::class, 'show'])->name('admin.data-umum.document-category.show');
        Route::post('/document-category/{id}/store', [DataUmumDocumentCategoryController::class, 'store'])->name('admin.data-umum.document-category.store');
        Route::put('/document-category/{id}/update', [DataUmumDocumentCategoryController::class, 'update'])->name('admin.data-umum.document-category.update');
        Route::delete('/document-category/{id}/destroy', [DataUmumDocumentCategoryController::class, 'destroy'])->name('admin.data-umum.document-category.destroy');
        // DuDcDetail
        Route::prefix('du-dc')->group(function () {
            Route::get('/{id}', [DataUmumDocumentCategoryController::class, 'detailFiles'])->name('admin.du-dc.index');
            Route::get('updateStatus/{id}', [DataUmumDocumentCategoryController::class, 'updateStatus'])->name('admin.du-dc.index.updateStatus');
    
            Route::post('/{id}/store', [DataUmumDocumentCategoryController::class, 'storeFile'])->name('admin.du-dc-detail.store');
            Route::delete('/{id}/destroy', [DataUmumDocumentCategoryController::class, 'destroyFile'])->name('admin.du-dc-detail.destroy');
            Route::get('downloadFile/{filename}', [DataUmumDocumentCategoryController::class, 'downloadFile'])->name('admin.du-dc.downloadFile');
            
        });
    });
});

Route::get('/download-template-laporan-mingguan/{data_umum}', [LaporanMingguanController::class, 'downloadTemplate'])->name('laporan-mingguan-uptd.downloadTemplate');
Route::get('/file-laporan/{path}', [UtilsController::class, 'fileLaporan'])->name('file-laporan.index');
