<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




Route::get('/login', [UserController::class, 'login'])->name('user.auth.login');
Route::get('/register', [UserController::class, 'register'])->name('user.auth.register');


Route::get('/', [UserController::class, 'beranda'])->name('beranda');
Route::get('/tentang', [UserController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [UserController::class, 'kontak'])->name('kontak');


Route::get('/motor', [UserController::class, 'motor'])->name('user.motor');
Route::get('/motor/{id}', [UserController::class, 'motorDetail'])->whereNumber('id')->name('user.motor.detail');