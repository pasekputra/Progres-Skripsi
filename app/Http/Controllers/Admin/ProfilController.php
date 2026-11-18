<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Kontrol profil: edit profil admin.
 * Tahap tampilan: method hanya mengembalikan view.
 * Logika database akan ditambahkan pada tahap berikutnya.
 */
class ProfilController extends Controller
{
    public function edit()
    {
        return view('admin.profil.edit');
    }
}