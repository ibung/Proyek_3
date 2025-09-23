<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<div class="welcome-box">
    <h2>Selamat Datang di Website Kampus XYZ, <?= esc(session()->get('full_name')); ?>!</h2>
    <p>Sistem Informasi Akademik untuk mengelola data mahasiswa</p>
</div>

<div class="feature-grid">
    <?php if (session()->get('role') === 'admin'): ?>
    <div class="feature-card">
        <h4>Kelola Mahasiswa</h4>
        <p>Ubah, hapus, dan kelola data mahasiswa yang sudah ada.</p>
        <a href="<?= base_url('admin/students'); ?>" class="btn-detail">Lihat Data</a>
    </div>

    <div class="feature-card" style="border-left-color: #28a745;">
        <h4>Tambah Mahasiswa Baru</h4>
        <p>Daftarkan mahasiswa baru ke dalam sistem akademik.</p>
        <a href="<?= base_url('admin/register'); ?>" class="btn-detail" style="background-color: #28a745;">Tambah Mahasiswa</a>
    </div>
    <?php endif; ?>
</div>

<div style="text-align: center; margin: 30px 0;">
    <h3>Tentang Kampus XYZ</h3>
    <p>Kampus XYZ merupakan institusi pendidikan tinggi yang berkomitmen memberikan pendidikan berkualitas. 
    Dengan dukungan sistem informasi modern, kami berusaha memberikan pelayanan terbaik dalam pengelolaan data akademik.</p>
</div>

<style>
/* Style asli dari file Anda */
.btn-detail { background-color: #3498db; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; }
.welcome-box { background-color: #3498db; color: white; padding: 30px; border-radius: 10px; margin: 20px 0; text-align: center; }
.feature-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin: 30px 0; }
.feature-card { background-color: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #3498db; text-align: center; }
.feature-card h4 { color: #2c3e50; margin-bottom: 10px; }
</style>

<?= $this->endSection(); ?>