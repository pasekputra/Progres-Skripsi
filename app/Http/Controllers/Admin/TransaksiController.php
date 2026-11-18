<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Kontrol transaksi: daftar dan tampilkan detail.
 * Tahap tampilan: method hanya mengembalikan view.
 * Logika database akan ditambahkan pada tahap berikutnya.
 */
class TransaksiController extends Controller
{
    public function indeks()
    {
        return view('admin.transaksi.index');
    }

    public function tampilkan($id)
    {
        return view('admin.transaksi.show', ['id' => $id]);
    }
}