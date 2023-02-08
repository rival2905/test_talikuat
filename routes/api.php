<?php

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

Route::post('get-data-pembangunan-by-uptd', [ProgressController::class, 'getDataPembangunanByUPTD'])->name('get-data-pembangunan-by-uptd');
