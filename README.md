## Project Status

### Migrasi (Database)

-   9 migrasi terbarui
-   Nama kolom direname ke Bahasa Indonesia (contoh: `name`→`nama`, `email_verified_at`→`email_diberikan_pada`, `price_per_day`→`harga_per_hari`, dan sebagainya)
-   Foreign keys diupdate: `category_id`→`kategori_id`, `user_id`→`pelanggan_id`
-   Tabel: `motor`, `kategori`, `pelanggan`, `pembayaran`, `notifikasi`, `cache`, `jobs`

### Model

-   `App\Models\User` - Sudah diupdate dengan kolom `kata_sandi`, `email_diberikan_pada`
-   `App\Models\Motor` - Memiliki relasi ke `Kategori` dan `Payment`
-   `App\Models\Kategori` - Relasi ke `Motor` (hasMany)
-   `App\Models\Admin`, `Notifikasi`, `Payment`

### Resource

-   `app/Http/MotorResource.php` - Resource untuk data motor
-   `app/Http/MotorCollection.php` - Collection motor
-   `app/Http/PaymentResource.php` - Resource untuk data pembayaran

### Seeder & UI (Rencana)

-   **Seeder**: Belum dibuat (`KategoriSeeder`, `MotorSeeder`) akan ditambahkan di `database/seeders/`
-   **UI**: Belum ada view auth; rencana membuat `resources/views/auth/login.blade.php`, `register.blade.php`, dan dashboard user
-   **Migrasi**: Bisa dijalankan `php artisan migrate:fresh --seed`

## Agentic Development

<!--  -->

Telah dilakukan hari ini:

1. ✅ database/migrations/2026_10_16_051948_sessions.php - diedit: menambahkan schema tabel sessions
2. ✅ resources/views/components/user/container.blade.php - dibuat: komponen Blade user.container
3. ✅ resources/views/components/user/button.blade.php - dibuat: komponen Blade user.button
4. ✅ Migrasi dijalankan: php artisan migrate → sessions table ter-create
   ### Hari Ini Ditambahkan (2026-10-16)

**Migrasi:**

-   Tabel `sessions` dibuat melalui migration `2026_10_16_051948_sessions.php` dengan schema:
    -   `id` (primary string)
    -   `user_id` (unsignedBigInteger, nullable)
    -   `ip_address` (string 45, nullable)
    -   `user_agent` (text, nullable)
    -   `payload` (text)
    -   `last_activity` (integer unsigned)

**Komponen Blade:**

-   `resources/views/components/user/container.blade.php` - dibuat untuk `<x-user.container>`
-   `resources/views/components/user/button.blade.php` - dibuat untuk `<x-user.button>`

**Database:**

-   `php artisan migrate` dijalankan sukses, status migrasi berubah menjadi `[2] Ran` untuk sessions

**Status Solusi Error:**

-   ✅ Error `SQLSTATE[42S02] Table 'project-skripsi.sessions' doesn't exist` - DISOLUSI
-   ✅ Error `InvalidArgumentException - Unable to locate a class or view for component [user.container]` - DISOLUSI
-   ✅ Error `InvalidArgumentException - Unable to locate a class or view for component [user.button]` - DISOLUSI
-   ✅ Model Motor, Resource, Views, Controller sudah konsisten dan kerja
