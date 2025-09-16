-----

## Sistem Informasi Akademik Sederhana

Ini adalah aplikasi web sederhana yang dibangun menggunakan **PHP** dengan framework **CodeIgniter 4**. Aplikasi ini berfungsi sebagai Sistem Informasi Akademik (SIAK) dasar yang mengelola data mahasiswa dan pengambilan mata kuliah.

-----

## Fitur Utama

Aplikasi ini memiliki dua hak akses (role) utama dengan fitur yang berbeda:

### 👤 Admin

  * **Login & Logout** yang aman.
  * **Dashboard** untuk melihat ringkasan.
  * **CRUD Mahasiswa**: Dapat menambah, melihat, mengedit (update), dan menghapus (delete) data mahasiswa.
  * **Pencarian**: Mencari mahasiswa berdasarkan Nama atau NIM.
  * **Enrollment**: Mengelola (menambah/menghapus) mata kuliah yang diambil oleh setiap mahasiswa.

### 🎓 Mahasiswa

  * **Login & Logout** yang aman.
  * **Lihat Profil**: Melihat detail data pribadi.
  * **Lihat Jadwal**: Melihat daftar mata kuliah yang sedang diambil.
  * **Enrollment Mandiri**: Mahasiswa dapat memilih dan mengubah sendiri mata kuliah yang ingin diambil dari daftar yang tersedia.

-----

## Teknologi yang Digunakan

  * **Framework**: CodeIgniter 4
  * **Bahasa**: PHP 8+
  * **Database**: MySQL
  * **Desain**: HTML & CSS Native
  * **Pola Arsitektur**: Model-View-Controller (MVC)

-----

## Panduan Instalasi

Berikut adalah cara untuk menjalankan proyek ini di lingkungan lokal Anda:

1.  **Clone atau Unduh Proyek**
    Pastikan Anda memiliki semua file proyek di dalam satu folder.

2.  **Setup Database**

      * Buat sebuah database baru di phpMyAdmin (contoh: `akademik_db`).
      * Impor file `.sql` yang berisi struktur tabel (`users`, `students`, `courses`, `takes`) dan contoh datanya.

3.  **Konfigurasi `.env`**

      * Salin file `env` (tanpa titik di depan) dan ubah namanya menjadi `.env`.
      * Buka file `.env` dan sesuaikan konfigurasi database:
        ```
        database.default.hostname = localhost
        database.default.database = akademik_db_w4
        database.default.username = root
        database.default.password = 
        database.default.DBDriver = MySQLi
        ```
      * Pastikan `app.baseURL` juga sudah benar:
        ```
        app.baseURL = 'http://localhost:8080'
        ```

4.  **Install Composer**
    Buka terminal atau command prompt di folder proyek, lalu jalankan perintah ini untuk menginstal dependensi:

    ```sh
    composer install
    ```

5.  **Jalankan Aplikasi**
    Masih di terminal, jalankan server pengembangan bawaan CodeIgniter:

    ```sh
    php spark serve
    ```

    Aplikasi sekarang dapat diakses melalui `http://localhost:8080` di browser Anda.

6.  **Akun untuk Login**

      * **Admin**:
          * Username: `admin`
          * Password: `admin123`
      * **Mahasiswa**:
          * Username: `ibnuu`
          * Password: `ibnuu123`
