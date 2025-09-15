<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<div class="welcome-box">
    <h2>Selamat Datang di Website SMA XYZ</h2>
    <p>Sistem Informasi Akademik untuk mengelola data siswa</p>
</div>

<div class="feature-grid">
    <div class="feature-card">
        <h4>Data Siswa</h4>
        <p>Kelola data siswa dengan mudah dan terorganisir</p>
        <a href="<?= base_url('mhs'); ?>" class="btn-detail">Lihat Data</a>
    </div>
</div>

<div style="text-align: center; margin: 30px 0;">
    <h3>Tentang SMA XYZ</h3>
    <p>SMA XYZ merupakan sekolah menengah atas yang berkomitmen memberikan pendidikan berkualitas tinggi. 
    Dengan dukungan sistem informasi modern, kami berusaha memberikan pelayanan terbaik dalam pengelolaan data akademik.</p>
</div>

<?= $this->endSection(); ?>