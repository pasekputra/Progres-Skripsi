<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Motor;
use Illuminate\Database\Seeder;

class MotorSeeder extends Seeder
{
    /**
     * Mengisi data contoh motor.
     * Pastikan KategoriSeeder dijalankan lebih dulu.
     */
    public function run(): void
    {
        $kategori = Kategori::pluck('id', 'nama');

        $daftarMotor = [
            // ---------- Matic ----------
            [
                'kategori'       => 'Matic',
                'nama'           => 'Honda Scoopy',
                'merk'           => 'Honda',
                'tahun_produksi' => 2023,
                'harga_per_hari' => 100000,
                'gambar'         => 'honda-scoopy.jpg',
                'deskripsi'      => 'Motor matic bergaya klasik, irit, dan nyaman untuk keliling kota.',
                'status'         => 'tersedia',
            ],
            [
                'kategori'       => 'Matic',
                'nama'           => 'Honda Vario 125',
                'merk'           => 'Honda',
                'tahun_produksi'           => 2022,
                'harga_per_hari' => 90000,
                'gambar'         => 'honda-vario-125.jpg',
                'deskripsi'      => 'Matic irit dengan bagasi lega, cocok untuk perjalanan harian.',
                'status'         => 'tersedia',
            ],
            [
                'kategori'       => 'Matic',
                'nama'           => 'Yamaha NMAX 155',
                'merk'           => 'Yamaha',
                'tahun_produksi'           => 2023,
                'harga_per_hari' => 180000,
                'gambar'         => 'yamaha-nmax-155.jpg',
                'deskripsi'      => 'Maxi scooter nyaman untuk perjalanan jauh dan berboncengan.',
                'status'         => 'tersedia',
            ],
            [
                'kategori'       => 'Matic',
                'nama'           => 'Honda PCX 160',
                'merk'           => 'Honda',
                'tahun_produksi'           => 2023,
                'harga_per_hari' => 200000,
                'gambar'         => 'honda-pcx-160.jpg',
                'deskripsi'      => 'Matic premium dengan mesin bertenaga dan kenyamanan berkendara.',
                'status'         => 'disewa',
            ],

            // ---------- Sport ----------
            [
                'kategori'       => 'Sport',
                'nama'           => 'Yamaha R15',
                'merk'           => 'Yamaha',
                'tahun_produksi'           => 2022,
                'harga_per_hari' => 250000,
                'gambar'         => 'yamaha-r15.jpg',
                'deskripsi'      => 'Motor sport fairing dengan tampilan sporty dan akselerasi responsif.',
                'status'         => 'tersedia',
            ],

            // ---------- Bebek ----------
            [
                'kategori'       => 'Bebek',
                'nama'           => 'Honda Supra X 125',
                'merk'           => 'Honda',
                'tahun_produksi'           => 2021,
                'harga_per_hari' => 70000,
                'gambar'         => 'honda-supra-x-125.jpg',
                'deskripsi'      => 'Motor bebek irit bahan bakar dan tangguh untuk pemakaian harian.',
                'status'         => 'tersedia',
            ],

            // ---------- Trail ----------
            [
                'kategori'       => 'Trail',
                'nama'           => 'Kawasaki KLX 150',
                'merk'           => 'Kawasaki',
                'tahun_produksi' => 2022,
                'harga_per_hari' => 220000,
                'gambar'         => 'kawasaki-klx-150.jpg',
                'deskripsi'      => 'Motor trail ringan untuk jalur menanjak dan medan kurang rata.',
                'status'         => 'tersedia',
            ],
        ];

        foreach ($daftarMotor as $data) {
            $kategoriNama = $data['kategori'];
            unset($data['kategori']);

            Motor::updateOrCreate(
                ['nama' => $data['nama']],
                $data + ['kategori_id' => $kategori[$kategoriNama]]
            );
        }
    }
}