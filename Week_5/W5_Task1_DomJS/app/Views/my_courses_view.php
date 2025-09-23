<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<h3>Jadwal Mata Kuliah Saya</h3>
<p>Berikut adalah daftar mata kuliah yang Anda ambil pada semester ini.</p>

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
.table-mahasiswa th, .table-mahasiswa td { border: 1px solid #ddd; padding: 12px; text-align: left; }
.table-mahasiswa th { background-color: #ecf0f1; color: #2c3e50; }
</style>

<?= $this->endSection(); ?>