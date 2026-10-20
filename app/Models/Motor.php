<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk tabel `motor` (sebelumnya tabel kendaraan).
 */
class Motor extends Model
{
    public const STATUS_TERSEDIA = 'tersedia';
    public const STATUS_DISEWA   = 'disewa';

    protected $table = 'motor';

    protected $fillable = [
        'kategori_id',
        'nama',
        'merk',
        'tahun_produksi',
        'harga_per_hari',
        'gambar',
        'deskripsi',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tahun_produksi'           => 'integer',
            'harga_per_hari' => 'decimal:2',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    /** Motor termasuk dalam satu kategori. */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /** Satu motor bisa muncul di banyak pembayaran/transaksi sewa. */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'motor_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Scope & helper
    |--------------------------------------------------------------------------
    */

    /** Motor::tersedia()->get() */
    public function scopeTersedia($query)
    {
        return $query->where('status', self::STATUS_TERSEDIA);
    }

    /** Motor::disewa()->get() */
    public function scopeDisewa($query)
    {
        return $query->where('status', self::STATUS_DISEWA);
    }

    public function isTersedia(): bool
    {
        return $this->status === self::STATUS_TERSEDIA;
    }
}