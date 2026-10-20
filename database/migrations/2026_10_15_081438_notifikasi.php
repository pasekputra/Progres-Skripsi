
2026 10 15 000006 buat tabel notifikasi · PHP
<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    /**
     * Membuat tabel notifikasi.
     */
    public function up(): void
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->uuid('id')->primary();                  // Primary Key, UUID (CHAR 36)
            $table->string('tipe', 255);                    // Kelas notifikasi (mis. RentalExpiringNotification)
            $table->morphs('notifiable');                   // notifiable_type & notifiable_id (Admin / Pelanggan)
            $table->text('data');                           // Isi notifikasi (format JSON)
            $table->timestamp('dibaca_pada')->nullable();       // Waktu notifikasi dibaca
            $table->timestamps();
        });
    }
 
    /**
     * Menghapus tabel notifikasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
 
