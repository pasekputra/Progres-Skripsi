<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Kontrol motor: daftar, buat baru, edit.
 * Tahap tampilan: method hanya mengembalikan view.
 * Logika database akan ditambahkan pada tahap berikutnya.
 */
class MotorController extends Controller
{
    public function indeks()
    {
        return view('admin.motor.index');
    }

    public function buat()
    {
        return view('admin.motor.create');
    }

    public function ubah($id)
    {
        return view('admin.motor.edit', ['id' => $id]);
    }
}