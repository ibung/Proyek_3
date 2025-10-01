<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<h3>📝 Edit Data Mahasiswa</h3>
<p>Anda sedang mengubah data untuk mahasiswa: <strong><?= esc($student['full_name']); ?></strong></p>

<?php if (session()->getFlashdata('errors')): ?>
    <div style="padding: 15px; margin: 20px 0; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; color: #721c24;">
        <strong>Perubahan Gagal Disimpan!</strong>
        <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('admin/students/update/' . $student['id']); ?>" method="post">
    <?= csrf_field(); ?>
    <input type="hidden" name="_method" value="POST"> <div class="form-group">
        <label for="full_name">Nama Lengkap</label>
        <input type="text" id="full_name" name="full_name" value="<?= old('full_name', esc($student['full_name'])); ?>" required>
    </div>
    <div class="form-group">
        <label for="nim">NIM</label>
        <input type="text" id="nim" name="nim" value="<?= old('nim', esc($student['nim'])); ?>" required>
    </div>
    <div class="form-group">
        <label for="age">Umur</label>
        <input type="number" id="age" name="age" value="<?= old('age', esc($student['age'])); ?>" required>
    </div>
    <div class="form-group">
        <label for="entry_year">Tahun Masuk</label>
        <input type="number" id="entry_year" name="entry_year" placeholder="Cth: 2023" value="<?= old('entry_year', esc($student['entry_year'])); ?>" required>
    </div>
    
    <button type="submit" class="btn-save">Update Data</button>
    <a href="<?= base_url('admin/students'); ?>" class="btn-cancel">Batal</a>
</form>

<style>
.form-group { margin-bottom: 20px; }
.form-group label { display: block; margin-bottom: 8px; font-weight: bold; }
.form-group input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
.btn-save { padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 10px; }
.btn-cancel { display: inline-block; padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px; font-size: 16px; margin-top: 10px; margin-left: 10px;}
</style>

<?= $this->endSection(); ?>