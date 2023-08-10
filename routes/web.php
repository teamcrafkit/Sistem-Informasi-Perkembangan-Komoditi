<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerUser\{AnggotaController, HomeController, PerkembanganController};
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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

Route::get('/', [HomeController::class, 'index'])->name('beranda');

    Route::get('login', [HomeController::class, 'loginPagePoktan'])->name('login.poktan');
    Route::post('login', [HomeController::class, 'login'])->name('login');

    Route::get('register', [HomeController::class, 'registerPagePoktan'])->name('register.poktan');
    Route::post('register', [HomeController::class, 'register'])->name('register');
    Route::get('logout', [HomeController::class, 'logout'])->name('logout.poktan')->middleware('auth:poktan');
    Route::middleware(['auth:poktan', 'verified'])->group(function () {
    Route::post('perkembangan-komoditi-ajax', [PerkembanganController::class, 'ajaxdata'])->name('perkembangan-komoditi.ajax');
    Route::get('perkembangan-komoditi/edit/{id}', [PerkembanganController::class, 'edit'])->name('perkembangan-komoditi.edit');
    Route::get('perkembangan-komoditi/tambah', [PerkembanganController::class, 'create'])->name('perkembangan-komoditi.create');
    Route::resource('perkembangan-komoditi', PerkembanganController::class)->except(['edit', 'show', 'create']);
    
    Route::post('anggota-kelompok-tani-ajax', [AnggotaController::class, 'ajaxdata'])->name('anggota-kelompok-tani.ajax');
    Route::get('anggota-kelompok-tani/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota-kelompok-tani.edit');
    Route::get('anggota-kelompok-tani/tambah', [AnggotaController::class, 'create'])->name('anggota-kelompok-tani.create');
    Route::resource('anggota-kelompok-tani', AnggotaController::class)->except(['edit', 'show', 'create']);

});

Auth::routes(['verify' => true]);

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('beranda')->with([
        'title' => 'Sukses!',
        'data'  => "Email anda berhasil di verifikasi!",
        'alert' => 'success',
    ]);
})->middleware(['auth:poktan', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return redirect()->route('beranda')->with([
        'title' => 'Perhatian!',
        'data'  => "Silahkan verifikasi email dulu guys!",
        'alert' => 'warning',
    ]);
})->middleware('auth:poktan')->name('verification.notice');