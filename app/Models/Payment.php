<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk tabel `payments` (transaksi sewa motor).
 */
class Payment extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_SUCCESS = 'success';
    public const STATUS_FAILED  = 'failed';
    public const STATUS_EXPIRED = 'expired';

    protected $table = 'payments';

    protected $fillable = [
        'user_id',
        'motor_id',
        'nama_motor',
        'tanggal_mulai',
        'tanggal_selesai',
        'total_hari',
        'jumlah',
        'status',
        'id_xendit',
        'metode_pembayaran',
        'bukti_pembayaran',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai'   => 'date',
            'tanggal_selesai' => 'date',
            'total_hari'      => 'integer',
            'jumlah'          => 'decimal:2',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    /** Pembayaran dimiliki oleh satu pelanggan. */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** Pembayaran merujuk ke satu motor. */
    public function motor()
    {
        return $this->belongsTo(Motor::class, 'motor_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Scope & helper
    |--------------------------------------------------------------------------
    */

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeSukses($query)
    {
        return $query->where('status', self::STATUS_SUCCESS);
    }

    public function isSukses(): bool
    {
        return $this->status === self::STATUS_SUCCESS;
    }
}