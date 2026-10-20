
2026 10 15 000002 buat tabel pelanggan · PHP
<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    /**
     * Membuat tabel pelanggan (user).
     */
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();                                   // Primary Key, auto increment
            $table->string('nama', 100);                    // Nama pelanggan
            $table->string('email', 100)->unique();         // Unique, digunakan untuk login
            $table->string('password', 255);                // Ter-hash
            $table->string('whatsapp', 20);                 // Nomor WhatsApp pelanggan
            $table->text('alamat');                         // Alamat pelanggan
            $table->timestamp('email_diberikan_pada')->nullable(); // Status verifikasi email
            $table->rememberToken();                        // Token sesi login
            $table->timestamps();                           // Tanggal dibuat & diperbarui
        });
    }
 
    /**
     * Menghapus tabel pelanggan.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
 
