# Sistem Manajemen Meeting

Sistem Manajemen Meeting adalah aplikasi berbasis web yang memungkinkan pengguna untuk mengelola jadwal pertemuan dengan antarmuka yang modern menggunakan Tailwind CSS.

## Persyaratan Sistem
- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Web server (Apache/Nginx)
- Browser modern dengan dukungan JavaScript

## Instalasi
1. Clone atau download repository ini
2. Buat database MySQL baru dengan nama `pbw_pertemuan9`
3. Import struktur database dari file SQL (jika tersedia)
4. Sesuaikan konfigurasi database di `koneksi.php`:
   ```php
   $host = "localhost";
   $user = "root";
   $pass = ""; 
   $db   = "pbw_pertemuan9";
   ```
5. Pastikan web server berjalan dan akses aplikasi melalui browser

## Daftar Isi
1. [Persyaratan Sistem](#persyaratan-sistem)
2. [Instalasi](#instalasi)
3. [Gambaran Umum](#gambaran-umum)
4. [Struktur File](#struktur-file)
5. [Fitur Utama](#fitur-utama)
6. [Alur Kerja Sistem](#alur-kerja-sistem)
7. [Panduan Penggunaan](#panduan-penggunaan)
8. [Keamanan](#keamanan)
9. [Struktur Database](#struktur-database)

## Gambaran Umum

Aplikasi ini memungkinkan pengguna untuk:
- Melihat daftar pertemuan yang terjadwal
- Mencari pertemuan dengan fitur saran otomatis
- Menambah dan mengedit detail pertemuan
- Menghapus pertemuan yang ada
- Mengelola sesi login dengan aman

## Struktur File

### 1. File Koneksi Database
- **koneksi.php**
  - Menangani koneksi ke database MySQL
  - Menggunakan karakter set UTF-8
  - Menerapkan penanganan kesalahan (error handling)

### 2. Sistem Autentikasi
- **php11D.php**
  - Halaman login dengan desain modern menggunakan Tailwind CSS
  - Form input username dan password
  - Validasi input dasar

- **php11D_action.php**
  - Memproses data login
  - Validasi kredensial pengguna
  - Membuat sesi setelah login berhasil

### 3. Manajemen Meeting
- **php11F.php**
  - Halaman utama daftar pertemuan
  - Tabel responsif dengan Tailwind CSS
  - Fitur pencarian dengan saran otomatis
  - Tombol untuk menambah pertemuan baru

- **php11F_header.php**
  - Navigasi header yang konsisten
  - Menu untuk akses ke daftar pertemuan
  - Tombol logout

### 4. Fitur Pencarian AJAX
- **php11F_suggestion.js**
  - Implementasi pencarian real-time
  - Mengirim permintaan AJAX ke server
  - Menampilkan saran nama pertemuan

- **php11F_gethint.php**
  - Endpoint AJAX untuk saran pencarian
  - Menggunakan prepared statement untuk keamanan
  - Mengembalikan data dalam format JSON

### 5. Pengelolaan Sesi
- **php11F_logout.php**
  - Mengakhiri sesi pengguna dengan aman
  - Menghapus cookie sesi
  - Pengalihan ke halaman login

### 6. Manajemen Data Pertemuan
- **php11G.php**
  - Form untuk menambah/edit pertemuan
  - Validasi input
  - Tampilan error yang informatif

- **php11G_action.php**
  - Memproses penambahan/pembaruan data pertemuan
  - Validasi server-side
  - Penanganan kesalahan yang aman

- **php11H.php**
  - Menangani penghapusan pertemuan
  - Konfirmasi sebelum penghapusan
  - Pengalihan yang aman setelah penghapusan

## Fitur Utama

1. **Autentikasi Pengguna**
   - Login dengan username dan password
   - Manajemen sesi yang aman
   - Logout yang terkontrol

2. **Manajemen Pertemuan**
   - Tampilan tabel yang responsif
   - Fungsi CRUD lengkap (Create, Read, Update, Delete)
   - Validasi input yang menyeluruh

3. **Pencarian Real-time**
   - Saran otomatis saat mengetik
   - Pencarian berbasis AJAX
   - Tampilan saran yang responsif

4. **Antarmuka Modern**
   - Desain responsif dengan Tailwind CSS
   - Tata letak yang bersih dan profesional
   - Pesan error yang informatif

## Alur Kerja Sistem

1. **Proses Login**
   - Pengguna mengakses php11D.php
   - Memasukkan kredensial
   - Sistem memvalidasi melalui php11D_action.php
   - Pengalihan ke halaman utama jika berhasil

2. **Manajemen Pertemuan**
   - Melihat daftar di php11F.php
   - Mencari dengan fitur saran otomatis
   - Menambah/edit melalui php11G.php
   - Menghapus menggunakan php11H.php

3. **Pencarian**
   - Input pencarian memicu php11F_suggestion.js
   - Request AJAX ke php11F_gethint.php
   - Menampilkan saran secara real-time

## Panduan Penggunaan

1. **Login**
   - Buka aplikasi melalui php11D.php
   - Masukkan username dan password
   - Sistem akan mengalihkan ke halaman utama

2. **Melihat Pertemuan**
   - Daftar pertemuan ditampilkan dalam tabel
   - Gunakan fitur pencarian untuk filter
   - Klik pada baris untuk detail

3. **Menambah/Edit Pertemuan**
   - Klik "Add Meeting" untuk baru
   - Klik "Edit" pada baris untuk update
   - Isi form yang tersedia
   - Submit untuk menyimpan

4. **Menghapus Pertemuan**
   - Klik "Delete" pada baris
   - Konfirmasi penghapusan
   - Sistem akan memperbarui tampilan

## Keamanan

1. **Validasi Input**
   - Validasi client-side dan server-side
   - Perlindungan terhadap SQL injection
   - Sanitasi data input

2. **Manajemen Sesi**
   - Timeout sesi
   - Penghapusan cookie yang aman
   - Validasi sesi pada setiap halaman

3. **Database**
   - Penggunaan prepared statements
   - Koneksi database yang aman
   - Penanganan error yang terkontrol

## Struktur Database

### Tabel `user`
Tabel untuk menyimpan data pengguna sistem.
```sql
CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
```

### Tabel `meetings`
Tabel untuk menyimpan data pertemuan.
```sql
CREATE TABLE meetings (
    slot INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);
```

---

Dikembangkan dengan ❤️ menggunakan PHP dan Tailwind CSS
