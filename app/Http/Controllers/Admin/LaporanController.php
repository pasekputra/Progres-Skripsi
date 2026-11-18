<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Kontrol laporan: daftar laporan.
 * Tahap tampilan: method hanya mengembalikan view.
 * Logika database akan ditambahkan pada tahap berikutnya.
 */
class LaporanController extends Controller
{
    public function indeks()
    {
        return view('admin.laporan.index');
    }
}