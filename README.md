# Mau Run — Website Event Lari (Laravel 12)

Aplikasi web untuk menampilkan informasi event lari dan pendaftaran peserta secara online, dibangun sesuai PRD "Website Event Lari Mau Run".

## Fitur

- **Admin**: login, dashboard, CRUD event lari (Nama, Jenis, Tanggal, Kota, Harga, Kuota, Deskripsi).
- **Peserta**: register & login (Username + Password), melihat & memfilter daftar event, mendaftar event (form: Nama Lengkap, Email, No. HP, Jenis Kelamin, Ukuran Jersey, Kode Kupon), kuota berkurang otomatis, riwayat pendaftaran.
- **Kupon**: D-10 (potong Rp10.000), D-20 (potong Rp20.000), D-50 (potong Rp50.000).
- **Data awal**: 4 event (Grow Run 2026, H Run 2026, HRSIY PDHI Fun Run, Sae Run).
- Tampilan menggunakan CSS custom (tanpa framework eksternal), responsif untuk mobile & desktop.

## Kebutuhan Sistem

- PHP >= 8.2
- Composer
- MySQL / MariaDB
- Ekstensi PHP umum Laravel (pdo_mysql, mbstring, openssl, tokenizer, xml, ctype, json)

> Catatan: source code ini dibuat secara manual mengikuti struktur resmi Laravel 12. Folder `vendor/` **tidak disertakan** dalam zip (praktik standar — tidak pernah di-commit), sehingga Anda perlu menjalankan `composer install` satu kali setelah ekstrak.

## Langkah Instalasi

1. **Ekstrak** file zip ini, lalu masuk ke foldernya:
   ```bash
   cd mauran
   ```

2. **Install dependency PHP** (mengunduh Laravel framework & library pendukung):
   ```bash
   composer install
   ```

3. **Salin file environment**:
   ```bash
   cp .env.example .env
   ```

4. **Buat database MySQL** bernama `mau_run` (via phpMyAdmin/MySQL CLI), atau import langsung file `database/mau_run.sql` yang sudah disediakan.

5. **Atur kredensial database** di file `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=mau_run
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Generate application key**:
   ```bash
   php artisan key:generate
   ```

7. **Jalankan migrasi & seeder** (membuat seluruh tabel + akun default + 4 data event):
   ```bash
   php artisan migrate --seed
   ```
   > Jika Anda sudah mengimpor `database/mau_run.sql` secara manual, cukup jalankan `php artisan db:seed` saja untuk membuat akun Admin/Peserta dengan password ter-enkripsi dengan benar.

8. **Jalankan server lokal**:
   ```bash
   php artisan serve
   ```
   Buka [http://127.0.0.1:8000](http://127.0.0.1:8000) di browser.

## Akun Default (hasil seeder)

| Peran   | Username  | Password    |
|---------|-----------|-------------|
| Admin   | admin     | admin123    |
| Peserta | peserta1  | peserta123  |

Silakan login sebagai Admin untuk mengelola event, atau Peserta untuk mencoba alur pendaftaran. Anda juga bisa membuat akun peserta baru sendiri lewat halaman **Daftar Peserta**.

## Struktur Proyek Penting

```
app/
  Http/Controllers/
    Auth/AuthController.php          -> login, register, logout
    Admin/DashboardController.php    -> dashboard admin
    Admin/EventController.php        -> CRUD event
    Peserta/EventController.php      -> listing & filter event
    Peserta/RegistrationController.php -> pendaftaran, kupon, kuota, riwayat
  Http/Middleware/
    EnsureUserIsAdmin.php
    EnsureUserIsPeserta.php
  Models/
    User.php, Event.php, Registration.php
database/
  migrations/                        -> struktur tabel
  seeders/                           -> data awal (admin, peserta, 4 event)
  mau_run.sql                        -> skrip SQL siap-import (schema + seed event)
public/css/app.css                   -> seluruh styling custom aplikasi
resources/views/                     -> seluruh tampilan Blade
routes/web.php                       -> seluruh routing
```

## Aturan Bisnis Utama

- Kuota event berkurang otomatis (1) setiap pendaftaran berhasil disimpan, dengan row-locking untuk mencegah race condition saat pendaftaran bersamaan.
- Pendaftaran ditolak otomatis jika kuota sudah 0 ("Kuota Penuh").
- Kode kupon divalidasi; kode tak dikenal akan menampilkan pesan error tanpa memotong harga.
- Satu peserta hanya bisa mendaftar sekali per event (unique constraint `user_id` + `event_id`).

## Lisensi

Dibuat untuk kebutuhan internal proyek (Project Web Pro 2 — Mau Run).

