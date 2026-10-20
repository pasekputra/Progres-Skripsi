
2026 10 15 000003 buat tabel kategori · PHP
<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    /**
     * Membuat tabel kategori.
     */
    public function up(): void
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();                                   // Primary Key, auto increment
            $table->string('nama', 50);                     // Nama kategori (contoh: Matic, Sport, Bebek)
            $table->timestamps();
        });
    }
 
    /**
     * Menghapus tabel kategori.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};
 
