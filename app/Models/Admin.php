<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model untuk tabel `admin`.
 */
class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';

    protected $fillable = [
        'username',
        'email',
        'password',
        'token',
    ];

    protected $hidden = [
        'password',
        'token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed', // otomatis di-hash saat disimpan
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi notifikasi (memakai tabel `notifikasi` dengan kolom berbahasa Indonesia)
    |--------------------------------------------------------------------------
    */

    public function notifications()
    {
        return $this->morphMany(Notifikasi::class, 'notifiable')->latest();
    }

    public function readNotifications()
    {
        return $this->notifications()->whereNotNull('dibaca_pada');
    }

    public function unreadNotifications()
    {
        return $this->notifications()->whereNull('dibaca_pada');
    }
}