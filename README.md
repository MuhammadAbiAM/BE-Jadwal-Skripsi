# CodeIgniter Installation Guide

## Prerequisites
Sebelum menginstal CodeIgniter, pastikan sistem Anda memenuhi persyaratan berikut:

- **Web Server**: Apache/Nginx dengan mod_rewrite diaktifkan
- **PHP**: Versi 7.4 atau lebih baru
- **Database**: MySQL, PostgreSQL, SQLite, atau lainnya yang didukung
- **Composer** (Opsional, untuk mengelola dependensi)

## Installation Steps

### 1. Download CodeIgniter

Anda dapat mengunduh CodeIgniter melalui beberapa cara:

#### a. Menggunakan Composer (Disarankan)
```bash
composer create-project codeigniter4/appstarter my_project
cd my_project
```

#### b. Mengunduh secara Manual
1. Unduh CodeIgniter dari [CodeIgniter Official Website](https://codeigniter.com/download).
2. Ekstrak file ke dalam folder proyek Anda.

### 2. Konfigurasi Dasar

#### a. Atur `baseURL`
Buka file `app/Config/App.php` dan sesuaikan bagian berikut:
```php
public $baseURL = 'http://localhost/my_project/';
```

#### b. Konfigurasi Database
Jika menggunakan database, ubah pengaturan pada `app/Config/Database.php`:
```php
public $default = [
    'DSN'      => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'nama_database',
    'DBDriver' => 'MySQLi',
];
```

### 3. Jalankan Server
Gunakan PHP built-in server untuk menjalankan aplikasi:
```bash
php spark serve
```
Akses aplikasi di browser melalui `http://localhost:8080`.

## Additional Setup

### 1. Mengaktifkan `mod_rewrite` (Jika Menggunakan Apache)
Pastikan file `.htaccess` tersedia dan konfigurasi `AllowOverride All` telah diaktifkan dalam Apache.

### 2. Menggunakan Environment File
Salin `.env.example` menjadi `.env` dan sesuaikan konfigurasi yang diperlukan:
```bash
cp env .env
```
Kemudian aktifkan mode development:
```bash
CI_ENVIRONMENT = development
```

## Troubleshooting

- **Error: Page Not Found**: Pastikan `mod_rewrite` diaktifkan jika menggunakan Apache.
- **Database Connection Error**: Cek kembali kredensial database pada `app/Config/Database.php`.
- **Permission Issues**: Pastikan folder `writable/` memiliki izin yang sesuai (`chmod -R 777 writable/`).

## More Information
Untuk dokumentasi lebih lanjut, kunjungi [CodeIgniter User Guide](https://codeigniter.com/user_guide/).

