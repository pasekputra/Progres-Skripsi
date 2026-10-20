
2026 10 15 000005 buat tabel pembayaran · PHP
<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    /**
     * Membuat tabel pembayaran (transaksi sewa motor).
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();                                   // Primary Key, auto increment
            $table->foreignId('user_id')                    // Foreign Key -> user.id
                  ->constrained('user')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->foreignId('motor_id')                   // ID motor yang disewa -> motor.id
                  ->constrained('motor')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();
            $table->string('nama_motor', 100);              // Nama motor (disimpan untuk riwayat,
                                                            // antisipasi data induk berubah)
            $table->date('tanggal_mulai');                     // Tanggal mulai sewa
            $table->date('tanggal_selesai');                       // Tanggal selesai sewa
            $table->integer('total_hari');                  // Jumlah hari sewa
            $table->decimal('jumlah', 12, 2);               // Total biaya
            $table->enum('status', ['pending', 'success', 'failed', 'expired','selesai'])
                  ->default('pending');                     // Status pembayaran
            $table->string('id_xendit', 100)->nullable();   // ID invoice dari Xendit
            $table->string('metode_pembayaran', 50)->nullable(); // VA / E-Wallet / Kartu Kredit
            $table->string('bukti_pembayaran', 255)->nullable(); // Path bukti pembayaran
            $table->timestamps();
        });
    }
 
    /**
     * Menghapus tabel pembayaran.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
 
