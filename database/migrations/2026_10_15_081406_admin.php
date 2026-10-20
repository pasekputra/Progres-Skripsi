
2026 10 15 000001 buat tabel admin · PHP
<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    /**
     * Membuat tabel admin.
     */
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id();                                   // Primary Key, auto increment
            $table->string('username', 100)->nullable(false)->unique("username_unique");                // Nama admin
            $table->string('email', 100)->unique();         // Unique, digunakan untuk login
            $table->string('password', 255);                // Ter-hash
            $table->string('token', 100)->nullable()->unique("token_unique");                        // Token sesi login (VARCHAR 100)
            $table->timestamps();                           // created_at & updated_at
        });
    }
 
    /**
     * Menghapus tabel admin.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
 
