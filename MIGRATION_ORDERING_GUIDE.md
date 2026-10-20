# Laravel Migration Ordering Guide

## Masalah
Migrasi Laravel diurutkan berdasarkan **filename timestamp**, bukan urutan logis ketergantungan tabel. Ini menyebabkan error saat ada foreign key antara tabel.

**Contoh error:**
- `motor` (081412) dijalankan sebelum `kategori` (081417) → `Failed to open the referenced table 'kategori'`
- `payments` (081422) dijalankan sebelum `user` (081427) → `Table 'user' doesn't exist`

## Solusi

### 1. Atur timestamp filename sesuai ketergantungan
- Tabel induk dibuat dulu → timestamp **lebih kecil**
- Tabel dependen dibuat setelah → timestamp **lebih besar**

| Tabel | File | Urutan |
|-------|------|--------|
| kategori | `2026_10_15_081410_kategori.php` | Dijalankan pertama |
| motor | `2026_10_15_081412_motor.php` | Dijalankan setelah kategori |
| user | `2026_10_15_081420_user.php` | Dijalankan pertama |
| payments | `2026_10_15_081422_payments.php` | Dijalankan setelah user |

### 2. Cara memperbaiki migration yang sudah ada
```powershell
# Ubah nama file migrasi
ren 2026_10_15_081417_kategori.php 2026_10_15_081410_kategori.php

# Reset dan jalankan ulang
php artisan migrate:reset
php artisan migrate
```

### 3. Checklist sebelum commit
- [ ] Tabel dengan foreign key dibuat sebelum tabel yang merujuk
- [ ] Urutan filename timestamp sudah benar (cek dengan `ls database/migrations/`)
- [ ] Jalankan `php artisan migrate:status` untuk verify

## Prevention
Selalu merencanakan urutan migrasi sebelum membuat file baru, terutama ketika ada hubungan antar tabel melalui foreign key.