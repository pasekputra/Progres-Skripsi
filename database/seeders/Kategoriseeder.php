<?php
 
namespace Database\Seeders;
 
use App\Models\Kategori;
use Illuminate\Database\Seeder;
 
class KategoriSeeder extends Seeder
{
    /**
     * Mengisi data kategori motor.
     */
    public function run(): void
    {
        $daftarKategori = ['Matic', 'Sport', 'Bebek', 'Trail'];
 
        foreach ($daftarKategori as $nama) {
            // updateOrCreate agar seeder aman dijalankan berulang kali
            Kategori::updateOrCreate(['nama' => $nama]);
        }
    }
}