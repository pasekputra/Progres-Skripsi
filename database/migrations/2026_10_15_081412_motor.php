
2026 10 15 000004 buat tabel motor · PHP
<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    /**
     * Membuat tabel motor (sebelumnya tabel kendaraan).
     */
    public function up(): void
    {
        Schema::create('motor', function (Blueprint $table) {
            $table->id();                                   // Primary Key, auto increment
            $table->foreignId('kategori_id')                // Foreign Key -> kategori.id
                  ->constrained('kategori')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();
            $table->string('nama', 100);                    // Nama motor
            $table->string('merk', 50);                    // Merk motor
            $table->year('tahun_produksi');                           // Tahun produksi
            $table->decimal('harga_per_hari', 10, 2);        // Harga sewa per hari
            $table->string('gambar', 255)->nullable();       // Nama file gambar
            $table->text('deskripsi')->nullable();        // Deskripsi motor
            $table->enum('status', ['tersedia', 'disewa'])  // Status ketersediaan
                  ->default('tersedia');
            $table->timestamps();
        });
    }
 
    /**
     * Menghapus tabel motor.
     */
    public function down(): void
    {
        Schema::dropIfExists('motor');
    }
};
 
