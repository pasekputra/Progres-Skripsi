<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk tabel `kategori` (contoh: Matic, Sport, Bebek).
 */
class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'nama',
    ];

    /** Satu kategori memiliki banyak motor. */
    public function motor()
    {
        return $this->hasMany(Motor::class, 'kategori_id');
    }
}