<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model untuk tabel `user` (pelanggan).
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    protected $fillable = [
        'nama',
        'email',
        'kata_sandi',
        'whatsapp',
        'alamat',
        'email_diberikan_pada',
    ];

    protected $hidden = [
        'kata_sandi',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_diberikan_pada' => 'datetime',
            'kata_sandi'           => 'hashed', // otomatis di-hash saat disimpan
        ];
    }

    /**
     * Kolom password bukan "password", jadi harus diberitahukan ke Laravel Auth.
     */
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    /*
    |--------------------------------------------------------------------------
    | Verifikasi email (kolom email_diberikan_pada = email_verified_at)
    |--------------------------------------------------------------------------
    | Jika ingin memakai fitur verifikasi email bawaan Laravel, tambahkan
    | `implements \Illuminate\Contracts\Auth\MustVerifyEmail` pada class ini.
    */

    public function hasVerifiedEmail(): bool
    {
        return ! is_null($this->email_diberikan_pada);
    }

    public function markEmailAsVerified(): bool
    {
        return $this->forceFill([
            'email_diberikan_pada' => $this->freshTimestamp(),
        ])->save();
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */
   /** Satu pelanggan memiliki banyak pembayaran. */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi notifikasi
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