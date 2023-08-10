<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('kecamatan', [ApiController::class, 'kecamatan'])->name('autocomplete.kecamatan');
Route::post('desa', [ApiController::class, 'desa'])->name('autocomplete.desa');
Route::post('jenis', [ApiController::class, 'jenis'])->name('autocomplete.jenis');