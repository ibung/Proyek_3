<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<h3>Detail Mahasiswa</h3>

<?php if (!empty($student)): ?>
    <div class="detail-box">
        <h4 style="color: #2c3e50; margin-bottom: 20px;">Informasi Pribadi</h4>
        
        <div style="display: grid; gap: 15px;">
            <div style="display: flex; align-items: center;">
                <strong style="min-width: 120px; color: #3498db;">NIM:</strong> 
                <span style="font-size: 16px;"><?= esc($student['nim']); ?></span>
            </div>
            
            <div style="display: flex; align-items: center;">
                <strong style="min-width: 120px; color: #3498db;">Nama Lengkap:</strong> 
                <span style="font-size: 16px;"><?= esc($student['full_name']); ?></span>
            </div>
            
            <div style="display: flex; align-items: center;">
                <strong style="min-width: 120px; color: #3498db;">Umur:</strong> 
                <span style="font-size: 16px;"><?= esc($student['age']); ?> tahun</span>
            </div>

            <div style="display: flex; align-items: center;">
                <strong style="min-width: 120px; color: #3498db;">Tahun Masuk:</strong> 
                <span style="font-size: 16px;"><?= esc($student['entry_year']); ?></span>
            </div>
        </div>
    </div>

<?php else: ?>
    <div style="text-align: center; padding: 40px; background-color: #fff3cd; border: 1px solid #ffeaa7; border-radius: 8px;">
        <h4 style="color: #856404; margin-bottom: 10px;">Data Mahasiswa Tidak Ditemukan</h4>
        <p style="color: #856404;">Data yang Anda cari mungkin telah dihapus atau tidak ada.</p>
    </div>
<?php endif; ?>

<br>
<?php
    $backUrl = (session()->get('role') === 'admin') 
        ? base_url('admin/students') 
        : base_url('home');
?>
<a href="<?= $backUrl; ?>" style="text-decoration: none; color: #3498db; font-weight: bold;">&larr; Kembali ke Daftar Mahasiswa</a>

<style>
/* Style asli dari file Anda */
.detail-box {
    background-color: #f8f9fa;
    padding: 30px;
    border-radius: 8px;
    border-left: 5px solid #3498db;
    margin-top: 20px;
}
</style>

<?= $this->endSection(); ?>