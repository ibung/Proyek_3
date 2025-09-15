<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<h3>👤 Detail Mahasiswa</h3>

<?php if (!empty($mahasiswa)): ?>
    <div class="detail-box">
        <h4 style="color: #2c3e50; margin-bottom: 20px;">Informasi Pribadi</h4>
        
        <div style="display: grid; gap: 15px;">
            <div style="display: flex; align-items: center;">
                <strong style="min-width: 120px; color: #3498db;">ID:</strong> 
                <span style="font-size: 16px;"><?= esc($mahasiswa['id']); ?></span>
            </div>
            
            <div style="display: flex; align-items: center;">
                <strong style="min-width: 120px; color: #3498db;">NIM:</strong> 
                <span style="font-size: 16px;"><?= esc($mahasiswa['nim']); ?></span>
            </div>
            
            <div style="display: flex; align-items: center;">
                <strong style="min-width: 120px; color: #3498db;">Nama:</strong> 
                <span style="font-size: 16px;"><?= esc($mahasiswa['nama']); ?></span>
            </div>
            
            <div style="display: flex; align-items: center;">
                <strong style="min-width: 120px; color: #3498db;">Umur:</strong> 
                <span style="font-size: 16px;"><?= esc($mahasiswa['umur']); ?> tahun</span>
            </div>
        </div>
    </div>

<?php else: ?>
    <div style="text-align: center; padding: 40px; background-color: #fff3cd; border: 1px solid #ffeaa7; border-radius: 8px;">
        <div style="font-size: 48px; margin-bottom: 15px;"></div>
        <h4 style="color: #856404; margin-bottom: 10px;">Data Mahasiswa Tidak Ditemukan</h4>
        <p style="color: #856404;">Maaf, data mahasiswa yang Anda cari tidak tersedia dalam sistem.</p>
    </div>
<?php endif; ?>

<div style="text-align: center; margin-top: 30px;">
    <a href="<?= base_url('mhs'); ?>" class="btn-kembali">
        ← Kembali ke Daftar Mahasiswa
    </a>
</div>

<?= $this->endSection(); ?>