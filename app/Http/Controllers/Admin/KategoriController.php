<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Kontrol kategori: mengelola data kategori.
 * Tahap tampilan: method hanya mengembalikan view.
 * Logika database akan ditambahkan pada tahap berikutnya.
 */
class KategoriController extends Controller
{
    public function tampilkan()
    {
        return view('admin.kategori.index');
    }
}