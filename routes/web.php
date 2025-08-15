<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Anggota\AngsuranController;
use App\Http\Controllers\Anggota\PinjamanController;
use App\Http\Controllers\Anggota\SlipGajiController;
use App\Http\Controllers\Staff\DataAnggotaController;
use App\Http\Controllers\Staff\DataAngsuranController;
use App\Http\Controllers\Staff\DataPinjamanController;
use App\Http\Controllers\Staff\DataSimpananController;
use App\Http\Controllers\Staff\DashboardStaffController;
use App\Http\Controllers\Staff\ManagePenggunaController;
use App\Http\Controllers\Anggota\FormPengajuanController;
use App\Http\Controllers\Staff\LaporanKeuanganController;
use App\Http\Controllers\Staff\PangkatPinjamanController;
use App\Http\Controllers\Anggota\DashboardAnggotaController;
use App\Http\Controllers\KepalaKoperasi\DashboardKepalaKoperasiController;

// Login
Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'Login'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    // Staff Pages
    Route::get('/dashboard', [DashboardStaffController::class, 'DashboardStaff'])->name('staff.dashboard');
    // Data Pinjaman
    Route::get('/data-pinjaman', [DataPinjamanController::class, 'index'])->name('data-pinjaman.index');
    Route::post('/data-pinjaman', [DataPinjamanController::class, 'store'])->name('data-pinjaman.store');
    Route::get('/data-pinjaman/{id}', [DataPinjamanController::class, 'show'])->name('data-pinjaman.show');
    Route::put('/data-pinjaman/{id}', [DataPinjamanController::class, 'update'])->name('data-pinjaman.update');
    Route::delete('/data-pinjaman/{id}', [DataPinjamanController::class, 'destroy'])->name('data-pinjaman.destroy');
});
// Route::get('/data-anggota', [DataAnggotaController::class, 'index'])->name('data-anggota.index');
Route::resource('data-anggota', DataAnggotaController::class);

// Route::get('/data-simpanan', [DataSimpananController::class, 'index'])->name('data-simpanan.index');
Route::resource('data-simpanan', DataSimpananController::class);


// Route::get('/data-pinjaman', [DataPinjamanController::class, 'index'])->name('data-pinjaman.index');


Route::get('/data-angsuran', [DataAngsuranController::class, 'index'])->name('data-angsuran.index');
Route::post('/data-angsuran', [DataAngsuranController::class, 'store'])->name('data-angsuran.store');
Route::get('/data-angsuran/{id}', [DataAngsuranController::class, 'show'])->name('data-angsuran.show');
Route::put('/data-angsuran/{id}', [DataAngsuranController::class, 'update'])->name('data-angsuran.update');
Route::delete('/data-angsuran/{id}', [DataAngsuranController::class, 'destroy'])->name('data-angsuran.destroy');


Route::get('/laporan-keuangan', [LaporanKeuanganController::class, 'index'])->name('laporan-keuangan.index');
Route::post('/laporan-keuangan', [LaporanKeuanganController::class, 'store'])->name('laporan-keuangan.store');
Route::get('/laporan-keuangan/{id}', [LaporanKeuanganController::class, 'show'])->name('laporan-keuangan.show');
Route::put('/laporan-keuangan/{id}', [LaporanKeuanganController::class, 'update'])->name('laporan-keuangan.update');
Route::delete('/laporan-keuangan/{id}', [LaporanKeuanganController::class, 'destroy'])->name('laporan-keuangan.destroy');


Route::get('/manage-pengguna', [ManagePenggunaController::class, 'index'])->name('manage-pengguna.index');
Route::post('/manage-pengguna', [ManagePenggunaController::class, 'store'])->name('manage-pengguna.store');
Route::get('/manage-pengguna/{id}', [ManagePenggunaController::class, 'show'])->name('manage-pengguna.show');
Route::put('/manage-pengguna/{id}', [ManagePenggunaController::class, 'update'])->name('manage-pengguna.update');
Route::delete('/manage-pengguna/{id}', [ManagePenggunaController::class, 'destroy'])->name('manage-pengguna.destroy');



Route::get('/pangkat-pinjaman', [PangkatPinjamanController::class, 'index'])->name('pangkat-pinjaman.index');


Route::middleware('auth')->group(function () {
    // Anggota pages
    Route::get('/dashboard-anggota', [DashboardAnggotaController::class, 'DashboardAnggota'])->name('anggota.dashboard-anggota');

    // Pengajuan Pinjaman
    Route::get('/form-pengajuan', [FormPengajuanController::class, 'index'])->name('form-pengajuan.index');
    Route::post('/form-pengajuan/store', [FormPengajuanController::class, 'store'])->name('form-pengajuan.store');

    // Pinjaman
    Route::get('/pinjaman-anggota', [PinjamanController::class, 'index'])->name('pinjaman.index.anggota');

    // Angsuran
    Route::get('/angsuran-anggota', [AngsuranController::class, 'index'])->name('angsuran.anggota.index');
    Route::post('/angsuran-anggota/store', [AngsuranController::class, 'store'])->name('angsuran.anggota.store');
    Route::get('/angsuran-anggota/cetak/{id}', [AngsuranController::class, 'cetakFaktur'])->name('angsuran.anggota.cetak.faktur');
});



Route::get('/slip-gaji', [SlipGajiController::class, 'index'])->name('slip-gaji.index');
Route::post('/slip-gaji', [SlipGajiController::class, 'store'])->name('slip-gaji.store');
Route::get('/slip-gaji/{id}', [SlipGajiController::class, 'show'])->name('slip-gaji.show');
Route::put('/slip-gaji/{id}', [SlipGajiController::class, 'update'])->name('slip-gaji.update');
Route::delete('/slip-gaji/{id}', [SlipGajiController::class, 'destroy'])->name('slip-gaji.destroy');


Route::middleware('auth')->group(function () {
    // Kepala Koperasi
    Route::get('/dashboard-kepala', [DashboardKepalaKoperasiController::class, 'DashboardKepalaKoperasi'])->name('pages.kepala-koperasi.dashboard-kepala');
    Route::post('/pengajuan/{id}/validasi', [DashboardKepalaKoperasiController::class, 'validasi'])->name('pengajuan.validasi');

    // Data Angsuran
    Route::get('/data-angsuran-kop', [DashboardKepalaKoperasiController::class, 'indexAngsuran'])->name('data.angsuran.kop');
    Route::get('/data-angsuran-kop/export', [DashboardKepalaKoperasiController::class, 'exportAngsuran'])->name('data.angsuran.export.kop');
    // Data Pinjaman
    Route::get('/data-pinjaman-kop', [DashboardKepalaKoperasiController::class, 'indexPinjaman'])->name('data.pinjaman.kop');
    Route::get('/data-pinjaman-kop/export', [DashboardKepalaKoperasiController::class, 'export'])->name('data.pinjaman.export.kop');
});


Route::get('/profile', [ProfileController::class, 'Profile'])->name('profile.index');


Route::get('/login-admin', [LoginAdminController::class, 'LoginAdmin'])->name('login-admin.index');



Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
