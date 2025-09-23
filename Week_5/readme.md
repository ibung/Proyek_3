# Proyek Sistem Informasi Akademik (SIAKAD) Sederhana

Proyek ini adalah sebuah sistem informasi akademik dasar yang dibangun menggunakan **CodeIgniter 4** dengan pola desain **MVC (Model-View-Controller)**. Aplikasi ini dirancang untuk mengelola data mahasiswa dan mata kuliah, serta menyediakan antarmuka yang interaktif dan modern berkat implementasi JavaScript untuk manipulasi DOM.

---

## 🚀 Fitur Utama

Sistem ini memiliki dua level akses pengguna dengan fungsionalitas yang berbeda:

### Sebagai Admin
-   **Manajemen Mahasiswa (CRUD)**: Admin memiliki kontrol penuh untuk Menambah, Melihat, Memperbarui, dan Menghapus data mahasiswa.
-   **Manajemen Mata Kuliah (CRUD)**: Admin dapat menambah, mengedit, dan menghapus data master untuk semua mata kuliah yang tersedia di universitas.
-   **Pencarian Data**: Fitur pencarian tersedia di halaman kelola mahasiswa untuk memfilter data berdasarkan nama atau NIM.
-   **Manajemen Jadwal Mahasiswa**: Admin dapat menetapkan atau mengubah mata kuliah yang diambil oleh setiap mahasiswa.

### Sebagai Mahasiswa
-   **Lihat Profil**: Mahasiswa dapat melihat detail data pribadi dan akademik mereka.
-   **Lihat Jadwal**: Menampilkan daftar mata kuliah yang sedang diambil pada semester berjalan.
-   **Ubah Jadwal**: Mahasiswa dapat secara mandiri memilih atau mengubah mata kuliah yang ingin diambil.

### Peningkatan Interaktivitas (JavaScript)
-   ✅ **Validasi Form Real-time**: Form Tambah dan Edit (untuk Mahasiswa & Mata Kuliah) divalidasi secara langsung di halaman. Input yang kosong akan menampilkan border merah dan pesan error tanpa perlu me-refresh halaman.
-   ✅ **Konfirmasi Aksi Aman**: Muncul dialog konfirmasi yang profesional sebelum admin menghapus data mahasiswa atau mata kuliah untuk mencegah kesalahan.
-   ✅ **Menu Navigasi Aktif**: Link pada menu utama akan otomatis ter-highlight sesuai dengan halaman atau bagian yang sedang diakses, memberikan petunjuk visual yang jelas kepada pengguna.
-   ✅ **Kalkulator SKS Live**: Pada halaman pemilihan mata kuliah, total SKS akan terhitung dan ditampilkan secara otomatis setiap kali mahasiswa mencentang atau menghilangkan centang sebuah mata kuliah.
-   ✅ **Notifikasi Modern**: Pesan sukses (misalnya setelah menambah data) akan muncul dan kemudian menghilang secara perlahan setelah beberapa detik.

---

## 🛠️ Teknologi yang Digunakan

-   **Backend**: PHP 8.1
-   **Framework**: CodeIgniter 4
-   **Frontend**: HTML, CSS, JavaScript (Vanilla JS)
-   **Database**: MySQL
-   **Pola Desain**: Model-View-Controller (MVC)
-   **Web Server**: Apache (via XAMPP)

---
