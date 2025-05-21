# BackEnd CodeIgniter - Sistem Penjadwalan Sidang Skripsi Otomatis

## Prerequisites
Sebelum menginstal CodeIgniter, pastikan sistem Anda memenuhi persyaratan berikut:

- **Web Server**: Apache/Nginx dengan mod_rewrite diaktifkan
- **PHP**: Versi 7.4 atau lebih baru
- **Database**: MySQL, PostgreSQL, SQLite, atau lainnya yang didukung
- **Composer**: untuk mengelola dependensi

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

### 2. Install Depedensi
Install semua dependensi yang dibutuhkan menggunakan Composer:
```php
composer install
```

### 3. Konfigurasi Environment

#### a. Atur env
Salin file .env.example menjadi .env dan atur konfigurasi database:
```php
cp env .env
```

#### b. Konfigurasi Database
Edit file .env dan sesuaikan dengan koneksi database lokal kamu:
```php
database.default.hostname = localhost
database.default.database = nama_database_anda
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

### 4. Jalankan Server
Gunakan PHP built-in server untuk menjalankan aplikasi:
```bash
php spark serve
```
Akses aplikasi di browser melalui `http://localhost:8080`.

### 5. Cek Endpoint API Menggunakan Postman
Gunakan Postman untuk mengetes endpoint berikut:

#### User
- GET → http://localhost:8080/user
- GET → http://localhost:8080/user/{id}

#### Mahasiswa
- GET → http://localhost:8080/mahasiswa
- GET → http://localhost:8080/mahasiswa/{id}
- POST → http://localhost:8080/mahasiswa
- PUT → http://localhost:8080/mahasiswa/{id}
- DELETE → http://localhost:8080/mahasiswa/{id}

#### Dosen
- GET → http://localhost:8080/dosen
- GET → http://localhost:8080/dosen/{id}
- POST → http://localhost:8080/dosen
- PUT → http://localhost:8080/dosen/{id}
- DELETE → http://localhost:8080/dosen/{id}

#### Ruangan
- GET → http://localhost:8080/ruangan
- GET → http://localhost:8080/ruangan/{id}
- POST → http://localhost:8080/ruangan
- PUT → http://localhost:8080/ruangan/{id}
- DELETE → http://localhost:8080/ruangan/{id}

#### Jadwal Sidang
- GET → http://localhost:8080/jadwal
- GET → http://localhost:8080/jadwal/{id}
- POST → http://localhost:8080/jadwal
- PUT → http://localhost:8080/jadwal/{id}
- DELETE → http://localhost:8080/jadwal/{id}

#### Penguji Sidang
- GET → http://localhost:8080/penguji
- GET → http://localhost:8080/penguji/{id}
- POST → http://localhost:8080/penguji
- PUT → http://localhost:8080/penguji/{id}
- DELETE → http://localhost:8080/penguji/{id}

#### Views
- GET → http://localhost:8080/view_jadwal
- GET → http://localhost:8080/view_jadwal/{id}
- GET → http://localhost:8080/view_penguji
- GET → http://localhost:8080/view_penguji/{id}
- GET → http://localhost:8080/view_penjadwalan
- GET → http://localhost:8080/view_penjadwalan/{id}

## More Information
Untuk dokumentasi lebih lanjut, kunjungi [CodeIgniter User Guide](https://codeigniter.com/user_guide/).

