SmartCashier: Integrated Web & Mobile Cashier System
SmartCashier adalah sistem manajemen kasir terintegrasi yang menggabungkan kekuatan Laravel 11 sebagai sistem manajemen basis data (Backend/Admin) dan Kotlin Native sebagai aplikasi terminal transaksi (Frontend Mobile). Proyek ini dikembangkan sebagai bagian dari tugas akademik di Politeknik Siber dan Sandi Negara.

🚀 Fitur Utama
Web Dashboard (Laravel)
Manajemen Data Transaksi: Melihat, menambah, dan mengelola data riwayat penjualan secara terpusat.

RESTful API Server: Menyediakan endpoint JSON untuk komunikasi data dengan aplikasi mobile.

Database Integration: Menggunakan MySQL untuk penyimpanan data yang persisten dan aman.

Mobile App (Kotlin Native)
Native Performance: Dibangun menggunakan kodingan Kotlin murni untuk kecepatan dan responsivitas maksimal.

Real-time Data Sync: Mengambil data transaksi dari server menggunakan library Retrofit.

Smart Selection: Fitur dropdown menu dengan kalkulasi harga otomatis untuk meminimalisir kesalahan input.

POST Transaction: Mengirim data pesanan baru langsung ke server Laravel melalui jaringan internet.

Gemini berkata
Tentu, Muhammad Agung. File README.md adalah wajah dari repositori GitHub Anda. Dosen atau calon rekruter akan melihat ini pertama kali untuk menilai kualitas kerja Anda.

Berikut adalah draf file README.md yang profesional, terstruktur, dan sudah mencakup penjelasan teknis tentang integrasi Laravel-Kotlin yang Anda buat.

SmartCashier: Integrated Web & Mobile Cashier System
SmartCashier adalah sistem manajemen kasir terintegrasi yang menggabungkan kekuatan Laravel 11 sebagai sistem manajemen basis data (Backend/Admin) dan Kotlin Native sebagai aplikasi terminal transaksi (Frontend Mobile). Proyek ini dikembangkan sebagai bagian dari tugas akademik di Politeknik Siber dan Sandi Negara.

🚀 Fitur Utama
Web Dashboard (Laravel)
Manajemen Data Transaksi: Melihat, menambah, dan mengelola data riwayat penjualan secara terpusat.

RESTful API Server: Menyediakan endpoint JSON untuk komunikasi data dengan aplikasi mobile.

Database Integration: Menggunakan MySQL untuk penyimpanan data yang persisten dan aman.

Mobile App (Kotlin Native)
Native Performance: Dibangun menggunakan kodingan Kotlin murni untuk kecepatan dan responsivitas maksimal.

Real-time Data Sync: Mengambil data transaksi dari server menggunakan library Retrofit.

Smart Selection: Fitur dropdown menu dengan kalkulasi harga otomatis untuk meminimalisir kesalahan input.

POST Transaction: Mengirim data pesanan baru langsung ke server Laravel melalui jaringan internet.

🛠️ Tech Stack
Komponen	Teknologi
Backend	Laravel 11 (PHP 8.x)
Frontend Mobile	Kotlin Native (Android SDK)
Database	MySQL / MariaDB
API Client	Retrofit 2 & GSON Converter
UI Design	XML Layout & Material Design

Sistem ini menggunakan arsitektur Client-Server berbasis REST API.
sequenceDiagram
    participant User as Kasir (Android)
    participant API as Laravel API
    participant DB as MySQL Database

    User->>API: GET /api/transaksi (Request Data)
    API->>DB: Query data terbaru
    DB-->>API: Result set
    API-->>User: Response JSON (List Transaksi)

    User->>API: POST /api/transaksi (Kirim Pesanan)
    API->>DB: Insert into table transaksis
    DB-->>API: Success Response
    API-->>User: Toast "Berhasil Disimpan"

⚙️ Cara Instalasi
1. Konfigurasi Backend (Laravel)
Clone repositori ini.

Jalankan composer install.

Duplikat file .env.example menjadi .env dan sesuaikan konfigurasi database.

Jalankan migrasi: php artisan migrate.

Aktifkan fitur API: php artisan install:api.

Jalankan server: php artisan serve --host=0.0.0.0.

2. Konfigurasi Frontend (Android)
Buka folder AndroidProject menggunakan Android Studio.

Buka MainActivity.kt.

Ubah variabel ipLaptop sesuai dengan alamat IPv4 laptop Anda (cek melalui ipconfig di CMD).

Pastikan HP Android dan Laptop berada dalam satu jaringan Wi-Fi yang sama.

Build dan Run aplikasi.