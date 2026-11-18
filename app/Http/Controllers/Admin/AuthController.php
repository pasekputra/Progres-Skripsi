<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
     public function masuk()
    {
        return view('admin.auth.login');
    }

    public function daftar()
    {
        return view('admin.auth.register');
    }
}
