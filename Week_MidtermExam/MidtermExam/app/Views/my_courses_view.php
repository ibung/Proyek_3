<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<h3>Jadwal Mata Kuliah Saya</h3>
<p>Berikut adalah daftar mata kuliah yang Anda ambil pada semester ini.</p>

<?php if (session()->getFlashdata('success')): ?>
    <div id="success-alert" style="padding: 15px; margin: 20px 0; background-color: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; color: #155724;">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<a href="<?= base_url('dashboard/enroll'); ?>" style="display: inline-block; margin-bottom: 20px; padding: 10px 15px; background-color: #ffc107; color: #212529; text-decoration: none; border-radius: 5px; font-weight: bold;">Ubah Jadwal</a>

<table class="table-mahasiswa">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode MK</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($courses)): ?>
            <?php $no = 1; foreach ($courses as $course): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($course['course_code']); ?></td>
                    <td><?= esc($course['course_name']); ?></td>
                    <td><?= esc($course['credits']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" style="text-align: center; padding: 20px; font-style: italic;">
                    Anda belum mengambil mata kuliah apapun.
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<style>
.table-mahasiswa { width: 100%; border-collapse: collapse; margin: 20px 0; }
.table-mahasiswa th, .table-mahasiswa td { border: 1px solid #ddd; padding: 12px; }
.table-mahasiswa th { background-color: #f2f2f2; }
</style>

<script>
    // Pilih elemen notifikasi
    const successAlert = document.getElementById('success-alert');

    // Jika notifikasi ada di halaman
    if (successAlert) {
        // Jalankan fungsi ini setelah 3.5 detik
        setTimeout(() => {
            // Buat transisi fade-out yang mulus
            successAlert.style.transition = 'opacity 0.5s ease';
            successAlert.style.opacity = '0';
            
            // Hapus elemen dari DOM setelah transisi selesai
            setTimeout(() => successAlert.remove(), 500);
        }, 3500);
    }
</script>

<?= $this->endSection(); ?>