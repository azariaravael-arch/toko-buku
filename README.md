# Proyek Perpustakaan (Library Project)

Aplikasi manajemen perpustakaan sederhana yang dibangun menggunakan Laravel.

## Prasyarat (Prerequisites)

Sebelum menjalankan proyek ini, pastikan Anda sudah menginstal:
- [PHP](https://www.php.net/downloads.php) (Versi 8.2 atau lebih baru)
- [Composer](https://getcomposer.org/download/)
- [Node.js & npm](https://nodejs.org/en/download/)
- [XAMPP](https://www.apachefriends.org/download.html) (Untuk lingkungan PHP lokal)

## Langkah-langkah Menjalankan Proyek

### 1. Persiapan Environment
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
*Catatan: Pastikan `DB_CONNECTION=sqlite` ada di dalam file `.env`.*

### 2. Instalasi Dependensi
Instal dependensi PHP menggunakan Composer:
```bash
composer install
```

Instal dependensi JavaScript menggunakan npm:
```bash
npm install
```

### 3. Setup Database
Buat file database SQLite kosong jika belum ada (di folder `database/database.sqlite`), lalu jalankan migrasi:
```bash
php artisan migrate --seed
```

### 4. Jalankan Aplikasi
Buka dua terminal terpisah:

**Terminal 1 (Server PHP):**
```bash
php artisan serve
```

**Terminal 2 (Compiler Asset/Vite):**
```bash
npm run dev
```

Aplikasi dapat diakses di: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Fitur Utama
- Manajemen Buku (CRUD)
- Peminjaman Buku
- Sistem Login/Auth
- UI Modern dengan Tailwind CSS

