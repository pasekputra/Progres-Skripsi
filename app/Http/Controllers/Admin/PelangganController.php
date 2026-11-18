<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Kontrol pelanggan: daftar dan detail.
 * Tahap tampilan: method hanya mengembalikan view.
 * Logika database akan ditambahkan pada tahap berikutnya.
 */
class PelangganController  extends Controller
{
    public function indeks()
    {
        return view('admin.pelanggan.index');
    }

    public function tampilkan($id)
    {
        return view('admin.pelanggan.show', ['id' => $id]);
    }
}