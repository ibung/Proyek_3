<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<h3><?= esc($title); ?></h3>

<?php 
    // Menentukan apakah ini form untuk 'edit' atau 'new'
    $isEdit = isset($course);
    $formAction = $isEdit ? base_url('admin/courses/update/' . $course['id']) : base_url('admin/courses/create');
?>

<?php if (session()->getFlashdata('errors')): ?>
    <div style="padding: 15px; margin: 20px 0; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; color: #721c24;">
        <strong>Gagal!</strong>
        <ul>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= $formAction; ?>" method="post">
    <?= csrf_field(); ?>
    
    <div class="form-group">
        <label for="course_code">Kode Mata Kuliah</label>
        <input type="text" id="course_code" name="course_code" value="<?= old('course_code', $course['course_code'] ?? ''); ?>" required>
    </div>

    <div class="form-group">
        <label for="course_name">Nama Mata Kuliah</label>
        <input type="text" id="course_name" name="course_name" value="<?= old('course_name', $course['course_name'] ?? ''); ?>" required>
    </div>

    <div class="form-group">
        <label for="credits">Jumlah SKS</label>
        <input type="number" id="credits" name="credits" value="<?= old('credits', $course['credits'] ?? ''); ?>" required>
    </div>
    
    <button type="submit" class="btn-save"><?= $isEdit ? 'Update Mata Kuliah' : 'Simpan Mata Kuliah'; ?></button>
    <a href="<?= base_url('admin/courses'); ?>" class="btn-cancel">Batal</a>
</form>

<style>
/* Style ini bisa dipindahkan ke CSS terpusat */
.form-group { margin-bottom: 20px; }
.form-group label { display: block; margin-bottom: 8px; font-weight: bold; }
.form-group input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
.btn-save { padding: 10px 20px; color: white; background-color: #007bff; border: none; border-radius: 5px; cursor: pointer; }
.btn-cancel { padding: 10px 20px; color: #333; background-color: #f0f0f0; text-decoration: none; border: 1px solid #ddd; border-radius: 5px; }
</style>

<?= $this->endSection(); ?>