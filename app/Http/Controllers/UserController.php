<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Motor;
use Illuminate\Http\Request;

class UserController extends Controller
{



      // Halaman masuk (tampilan saja)
    public function login()
    {
        return view('user.auth.login');
    }
 
    // Halaman daftar (tampilan saja)
    public function register()
    {
        return view('user.auth.register');
    }
    

    public function beranda()

    {
        // 3 motor tersedia terbaru
        $motors = Motor::with('kategori')->tersedia()->latest()->take(3)->get();

        $totalMotor    = Motor::count();
        $totalTersedia = Motor::tersedia()->count();

        return view('user.beranda', compact('motors', 'totalMotor', 'totalTersedia'));
    }


  

 // Menampilkan semua motor (pencarian, filter kategori, urutan, pagination)    
    public function motor(Request $request)
    {
        // Ambil parameter pencarian dan filter
        $search     = trim((string) $request->query('search', ''));
        $sort       = $request->query('sort', 'terbaru'); // terbaru | termurah | termahal
        $kategoriId = $request->query('kategori');
 
        // Urutan; id ikut diurutkan agar pagination stabil
        [$kolom, $arah] = match ($sort) {
            'termurah' => ['harga_per_hari', 'asc'],
            'termahal' => ['harga_per_hari', 'desc'],
            default    => ['created_at', 'desc'],
        };
 
        $motors = Motor::with('kategori')
            // where dikelompokkan supaya "OR" tidak merusak filter lain
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('merk', 'like', "%{$search}%");
                });
            })
            ->when($kategoriId, fn ($query, $id) => $query->where('kategori_id', $id))
            ->orderBy($kolom, $arah)
            ->orderBy('id', 'desc')
            // 6 motor per halaman, parameter pencarian ikut terbawa di link halaman
            ->paginate(6)
            ->withQueryString();
 
        $daftarKategori = Kategori::orderBy('nama')->get();
 
        return view('user.motor', compact('motors', 'search', 'sort', 'kategoriId', 'daftarKategori'));
    }
 
    // Menampilkan detail satu motor
    public function motorDetail($id)
    {
        $motor = Motor::with('kategori')->findOrFail($id);
 
        // Motor terkait (merk sama atau harga per hari mirip)
        $relatedMotors = Motor::with('kategori')
            ->where('id', '!=', $id)
            ->where(function ($query) use ($motor) {
                $query->where('merk', $motor->merk)
                      ->orWhereBetween('harga_per_hari', [$motor->harga_per_hari * 0.7, $motor->harga_per_hari * 1.3]);
            })
            ->limit(4)
            ->get();
 
        return view('user.motor_detail', compact('motor', 'relatedMotors'));
    }



    // tentang


    public function tentang()
    {
        // Hanya data statis yang tidak berubah (angka, URL, dll)
        $data = [
            'stats' => [
                'motor'     => 50,
                'mobil'     => 30,
                'pelanggan' => 500,
                'pengalaman' => now()->year - 2020,
            ],

            'kontak' => [
                'alamat'          => 'Br. Tohjiwa, Nyambu, Kediri, Tabanan, Bali',
                'maps'            => 'https://maps.app.goo.gl/tbGvf156tCnhq5E76',
                'telepon'         => '087810179370',
                'email'           => 'putriayurentbike@gmail.com',
                'jam_operasional' => 'Senin – Minggu, 07.00 – 21.00 WIB',
                'jam_buka'        => 7,
                'jam_tutup'       => 21,
                'whatsapp'        => '6287810179370',
            ],
        ];

        return view('user.tentang', compact('data'));
    }


    // kontak
    public function kontak()
    {
        $data = [
            'kontak' => [
                'alamat' => 'Br. Tohjiwa, Nyambu, Kediri, Tabanan, Bali',
                'maps' => 'https://maps.app.goo.gl/tbGvf156tCnhq5E76',
                'telepon' => '087810179370',
                'email' => 'putriayurentbike@gmail.com',
                'jam_operasional' => 'Senin – Minggu, 07.00 – 21.00 WIB',
                'jam_buka' => 7,
                'jam_tutup' => 21,
                'whatsapp' => '6287810179370',
            ],
            'sosmed' => [

            
                'instagram' => 'https://instagram.com/putriayurent',
                'facebook' => 'https://facebook.com/putriayurent',
                'twitter' => 'https://twitter.com/putriayurent',
                'tiktok' => 'https://tiktok.com/@putriayurent',
            ]
        ];
        
        return view('user.kontak', compact('data'));
    }








}
