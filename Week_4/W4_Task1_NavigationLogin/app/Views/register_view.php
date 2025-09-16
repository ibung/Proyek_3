<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<h3>➕ Tambah Mahasiswa Baru</h3>
<p>Isi formulir di bawah ini untuk mendaftarkan mahasiswa baru ke dalam sistem.</p>

<?php if (session()->getFlashdata('errors')): ?>
    <div style="padding: 15px; margin: 20px 0; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; color: #721c24;">
        <strong>Pendaftaran Gagal!</strong>
        <ul style="margin-top: 10px; padding-left: 20px;">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('admin/register/process'); ?>" method="post" style="margin-top: 20px;">
    <?= csrf_field(); ?>

    <h4 style="margin-top: 20px; margin-bottom: 15px; border-bottom: 1px solid #ddd; padding-bottom: 10px;">Data Akademik Mahasiswa</h4>
    <div class="form-group">
        <label for="full_name">Nama Lengkap</label>
        <input type="text" id="full_name" name="full_name" value="<?= old('full_name') ?>" required>
    </div>
    <div class="form-group">
        <label for="nim">NIM (Nomor Induk Mahasiswa)</label>
        <input type="text" id="nim" name="nim" value="<?= old('nim') ?>" required>
    </div>
    <div class="form-grid">
        <div class="form-group">
            <label for="age">Umur</label>
            <input type="number" id="age" name="age" value="<?= old('age') ?>" required>
        </div>
        <div class="form-group">
            <label for="entry_year">Tahun Masuk</label>
            <input type="number" id="entry_year" name="entry_year" placeholder="Cth: 2023" value="<?= old('entry_year') ?>" required>
        </div>
    </div>
    
    <h4 style="margin-top: 30px; margin-bottom: 15px; border-bottom: 1px solid #ddd; padding-bottom: 10px;">Data Akun Login</h4>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= old('username') ?>" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    
    <button type="submit" class="btn-save">Tambahkan Mahasiswa</button>
    <a href="<?= base_url('admin/students'); ?>" class="btn-cancel">Batal</a>
</form>

<style>
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.form-group { margin-bottom: 20px; }
.form-group label { display: block; margin-bottom: 8px; font-weight: bold; }
.form-group input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
.btn-save { padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 10px; }
.btn-cancel { display: inline-block; padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px; font-size: 16px; margin-top: 10px; margin-left: 10px;}
</style>

<?= $this->endSection(); ?>