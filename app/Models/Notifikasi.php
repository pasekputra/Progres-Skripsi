<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotificationCollection;

/**
 * Model untuk tabel `notifikasi`.
 *
 * Laravel secara bawaan memakai kolom `type` dan `read_at`, sedangkan di
 * migration kolomnya bernama `tipe` dan `dibaca_pada`. Model ini menjembatani
 * keduanya, jadi channel "database" bawaan Laravel tetap berfungsi.
 */
class Notifikasi extends Model
{
    protected $table = 'notifikasi';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'data'        => 'array',
            'dibaca_pada' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Penjembatan nama kolom (type -> tipe, read_at -> dibaca_pada)
    |--------------------------------------------------------------------------
    */

    public function setTypeAttribute($value): void
    {
        $this->attributes['tipe'] = $value;
    }

    public function getTypeAttribute()
    {
        return $this->attributes['tipe'] ?? null;
    }

    public function setReadAtAttribute($value): void
    {
        $this->attributes['dibaca_pada'] = $value ? $this->fromDateTime($value) : null;
    }

    public function getReadAtAttribute()
    {
        return $this->dibaca_pada;
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    /** Penerima notifikasi (User atau Admin). */
    public function notifiable()
    {
        return $this->morphTo();
    }

    /*
    |--------------------------------------------------------------------------
    | Helper baca / belum dibaca
    |--------------------------------------------------------------------------
    */

    public function markAsRead(): void
    {
        if (is_null($this->dibaca_pada)) {
            $this->forceFill(['dibaca_pada' => $this->freshTimestamp()])->save();
        }
    }

    public function markAsUnread(): void
    {
        if (! is_null($this->dibaca_pada)) {
            $this->forceFill(['dibaca_pada' => null])->save();
        }
    }

    public function read(): bool
    {
        return ! is_null($this->dibaca_pada);
    }

    public function unread(): bool
    {
        return is_null($this->dibaca_pada);
    }

    public function scopeSudahDibaca($query)
    {
        return $query->whereNotNull('dibaca_pada');
    }

    public function scopeBelumDibaca($query)
    {
        return $query->whereNull('dibaca_pada');
    }

    /** Agar $user->unreadNotifications->markAsRead() tetap bisa dipakai. */
    public function newCollection(array $models = []): DatabaseNotificationCollection
    {
        return new DatabaseNotificationCollection($models);
    }
}