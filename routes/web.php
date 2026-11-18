<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MotorController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\NotifikasiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Admin routes (baru ditambahkan)
Route::prefix('putriayu/admin')->group(function () {

Route::get('/', [DashboardController::class, 'tampilkan'])->name('admin.dashboard');
Route::get('/login', [AuthController::class, 'masuk'])->name('admin.login');
Route::get('/register', [AuthController::class, 'daftar'])->name('admin.register');


Route::prefix('motor')->group(function () {
        Route::get('/', [MotorController::class, 'indeks'])->name('admin.motor.index');
        Route::get('buat', [MotorController::class, 'buat'])->name('admin.motor.create');
        Route::get('ubah/{id}', [MotorController::class, 'ubah'])->name('admin.motor.edit');
    });

    Route::get('kategori', [KategoriController::class, 'tampilkan'])->name('admin.kategori.index');

    Route::prefix('pelanggan')->group(function () {
        Route::get('/', [PelangganController::class, 'indeks'])->name('admin.pelanggan.index');
        Route::get('detail/{id}', [PelangganController::class, 'tampilkan'])->name('admin.pelanggan.show');
    });

    Route::prefix('transaksi')->group(function () {
        Route::get('/', [TransaksiController::class, 'indeks'])->name('admin.transaksi.index');
        Route::get('detail/{id}', [TransaksiController::class, 'tampilkan'])->name('admin.transaksi.show');
    });

    Route::get('profil/edit', [ProfilController::class, 'edit'])->name('admin.profil.edit');

    Route::get('laporan', [LaporanController::class, 'indeks'])->name('admin.laporan.index');

    Route::get('notifikasi', [NotifikasiController::class, 'indeks'])->name('admin.notifikasi.index');
});


Route::prefix('/putriayu')->group(function () {

Route::get('/login', [UserController::class, 'login'])->name('user.auth.login');
Route::get('/register', [UserController::class, 'register'])->name('user.auth.register');

Route::get('/', [UserController::class, 'beranda'])->name('beranda');
Route::get('/tentang', [UserController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [UserController::class, 'kontak'])->name('kontak');

Route::get('/motor', [UserController::class, 'motor'])->name('user.motor');
Route::get('/motor/{id}', [UserController::class, 'motorDetail'])->whereNumber('id')->name('user.motor.detail');
});