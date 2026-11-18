<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Kontrol notifikasi: daftar notifikasi.
 * Tahap tampilan: method hanya mengembalikan view.
 * Logika database akan ditambahkan pada tahap berikutnya.
 */
class NotifikasiController extends Controller
{
    public function indeks()
    {
        return view('admin.notifikasi.index');
    }
}