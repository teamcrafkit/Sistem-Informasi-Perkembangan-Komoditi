<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerAdmin\{
    AnggotaController,
    AuthController,
    DashboardController,
    DesaController,
    GrafikController,
    JenisKomoditiController,
    KecamatanController,
    KelompokTaniController,
    LaporanController,
    MenuController,
    PenggunaController,
    PeranController,
    PeranPenggunaController,
    PerizinanController,
    PerizinanPeranController,
    PerkembanganController,
};

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

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login-admin');
    Route::post('auth', [AuthController::class, 'authenticate'])->name('auth');
});

Route::middleware('hasrole')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('permission:Pengaturan Menu')->group(function () {
        //! @route : pengaturan-menu */
        Route::post('pengaturan-menu-ajax', [MenuController::class, 'ajaxdata'])->name('pengaturan-menu.ajax');
        Route::get('pengaturan-menu/edit/{id}', [MenuController::class, 'edit'])->name('pengaturan-menu.edit');
        Route::resource('pengaturan-menu', MenuController::class)->except(['edit', 'show']);
    });

    Route::middleware('permission:Peran Dan Perizinan')->group(function () {
        //! @route : peran */
        Route::post('peran-ajax', [PeranController::class, 'ajaxdata'])->name('peran.ajax');
        Route::get('peran/edit/{id}', [PeranController::class, 'edit'])->name('peran.edit');
        Route::get('peran/tambah', [PeranController::class, 'create'])->name('peran.create');
        Route::resource('peran', PeranController::class)->except(['edit', 'create']);

        //! @route : perizinan */
        Route::post('perizinan-ajax', [PerizinanController::class, 'ajaxdata'])->name('perizinan.ajax');
        Route::get('perizinan/edit/{id}', [PerizinanController::class, 'edit'])->name('perizinan.edit');
        Route::get('perizinan/tambah', [PerizinanController::class, 'create'])->name('perizinan.create');
        Route::resource('perizinan', PerizinanController::class)->except(['edit', 'create']);

        //! @route : perizinan-peran */
        Route::post('perizinan-peran-ajax', [PerizinanPeranController::class, 'ajaxdata'])->name('perizinan-peran.ajax');
        Route::get('perizinan-peran/edit/{id}', [PerizinanPeranController::class, 'edit'])->name('perizinan-peran.edit');
        Route::get('perizinan-peran/tambah', [PerizinanPeranController::class, 'create'])->name('perizinan-peran.create');
        Route::resource('perizinan-peran', PerizinanPeranController::class)->except(['edit', 'create']);

        //! @route : peran-pengguna */
        Route::post('peran-pengguna-ajax', [PeranPenggunaController::class, 'ajaxdata'])->name('peran-pengguna.ajax');
        Route::get('peran-pengguna/edit/{id}', [PeranPenggunaController::class, 'edit'])->name('peran-pengguna.edit');
        Route::get('peran-pengguna/tambah', [PeranPenggunaController::class, 'create'])->name('peran-pengguna.create');
        Route::resource('peran-pengguna', PeranPenggunaController::class)->except(['edit', 'create']);
    });

    Route::middleware('permission:Pengaturan Pengguna')->group(function () {
        //! @route : pengaturan-pengguna */
        Route::post('pengaturan-pengguna-ajax', [PenggunaController::class, 'ajaxdata'])->name('pengaturan-pengguna.ajax');
        Route::get('pengaturan-pengguna/edit/{id}', [PenggunaController::class, 'edit'])->name('pengaturan-pengguna.edit');
        Route::get('pengaturan-pengguna/tambah', [PenggunaController::class, 'create'])->name('pengaturan-pengguna.create');
        Route::resource('pengaturan-pengguna', PenggunaController::class)->except(['edit', 'show', 'create']);
    });

    Route::middleware('permission:Data Kecamatan')->group(function () {
        //! @route : data-kecamatan */
        Route::post('data-kecamatan-ajax', [KecamatanController::class, 'ajaxdata'])->name('data-kecamatan.ajax');
        Route::get('data-kecamatan/edit/{id}', [KecamatanController::class, 'edit'])->name('data-kecamatan.edit');
        Route::get('data-kecamatan/tambah', [KecamatanController::class, 'create'])->name('data-kecamatan.create');
        Route::resource('data-kecamatan', KecamatanController::class)->except(['edit', 'show', 'create']);
    });

    Route::middleware('permission:Data Desa')->group(function () {
        //! @route : data-desa */
        Route::post('data-desa-ajax', [DesaController::class, 'ajaxdata'])->name('data-desa.ajax');
        Route::get('data-desa/edit/{id}', [DesaController::class, 'edit'])->name('data-desa.edit');
        Route::get('data-desa/tambah', [DesaController::class, 'create'])->name('data-desa.create');
        Route::resource('data-desa', DesaController::class)->except(['edit', 'show', 'create']);
    });

    Route::middleware('permission:Data Jenis Komoditi')->group(function () {
        //! @route : data-jenis-komoditi */
        Route::post('data-jenis-komoditi-ajax', [JenisKomoditiController::class, 'ajaxdata'])->name('data-jenis-komoditi.ajax');
        Route::get('data-jenis-komoditi/edit/{id}', [JenisKomoditiController::class, 'edit'])->name('data-jenis-komoditi.edit');
        Route::get('data-jenis-komoditi/tambah', [JenisKomoditiController::class, 'create'])->name('data-jenis-komoditi.create');
        Route::resource('data-jenis-komoditi', JenisKomoditiController::class)->except(['edit', 'show', 'create']);
    });

    Route::middleware('permission:Data Kelompok Tani')->group(function () {
        //! @route : data-kelompok-tani */
        Route::post('data-kelompok-tani-ajax', [KelompokTaniController::class, 'ajaxdata'])->name('data-kelompok-tani.ajax');
        Route::get('data-kelompok-tani/edit/{id}', [KelompokTaniController::class, 'edit'])->name('data-kelompok-tani.edit');
        Route::get('data-kelompok-tani/tambah', [KelompokTaniController::class, 'create'])->name('data-kelompok-tani.create');
        Route::resource('data-kelompok-tani', KelompokTaniController::class)->except(['edit', 'show', 'create']);
    });
    Route::middleware('permission:Anggota Kelompok')->group(function () {
        //! @route : anggota-kelompok */
        Route::post('anggota-kelompok-ajax', [AnggotaController::class, 'ajaxdata'])->name('anggota-kelompok.ajax');
        Route::get('anggota-kelompok/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota-kelompok.edit');
        Route::get('anggota-kelompok/tambah', [AnggotaController::class, 'create'])->name('anggota-kelompok.create');
        Route::resource('anggota-kelompok', AnggotaController::class)->except(['edit', 'show', 'create']);
    });

    Route::middleware('permission:Perkembangan Komoditi')->group(function () {
        //! @route : perkembangan-komoditi */
        Route::post('perkembangan-komoditi-ajax', [PerkembanganController::class, 'ajaxdata'])->name('perkembangan-komoditi-admin.ajax');
        Route::get('perkembangan-komoditi/detail/{id}', [PerkembanganController::class, 'detail'])->name('perkembangan-komoditi-admin.detail');
        Route::put('perkembangan-komoditi/status/{id}', [PerkembanganController::class, 'status'])->name('perkembangan-komoditi-admin.status');
        Route::get('perkembangan-komoditi', [PerkembanganController::class, 'index'])->name('perkembangan-komoditi-admin.index');
    });

    Route::middleware('permission:Data Laporan')->group(function () {
        //! @route : data-laporan */
        Route::get('data-laporan', [LaporanController::class, 'index'])->name('data-laporan.index');
        Route::get('data-laporan/anggota/{id}', [LaporanController::class, 'detail'])->name('data-laporan.detail');
        Route::post('data-laporan', [LaporanController::class, 'show'])->name('data-laporan.show');
    });
    Route::middleware('permission:Data Grafik')->group(function () {
        //! @route : data-grafik */
        Route::get('data-grafik', [GrafikController::class, 'index'])->name('data-grafik.index');
        Route::post('data-grafik', [GrafikController::class, 'show'])->name('data-grafik.show');
    });
});
