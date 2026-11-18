<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Pusat kontrol dashboard admin.
 * Method hanya mengembalikan view, logika database akan ditambahkan pada tahap selanjutnya.
 */
class DashboardController extends Controller
{
    public function tampilkan()
    {
        return view('admin.dashboard');
    }
}