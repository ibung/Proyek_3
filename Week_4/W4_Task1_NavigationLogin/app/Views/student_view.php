<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>

<h3><?= esc($title); ?></h3>
<p>Berikut adalah daftar mahasiswa yang terdaftar di sistem Kampus XYZ.</p>

<?php if (session()->getFlashdata('success')): ?>
    <div style="padding: 15px; margin: 20px 0; background-color: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; color: #155724;">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div style="padding: 15px; margin: 20px 0; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; color: #721c24;">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<?php if (session()->get('role') === 'admin'): ?>
<form method="GET" action="<?= base_url('admin/students'); ?>" style="margin-bottom: 20px;">
    <input type="text" name="search" placeholder="Cari NIM atau Nama..." value="<?= esc($keyword); ?>" style="padding: 8px; width: 300px; border-radius: 5px; border: 1px solid #ddd;">
    <button type="submit" style="padding: 8px 15px; border-radius: 5px; border: none; background-color: #3498db; color: white; cursor: pointer;">Cari</button>
</form>
<?php endif; ?>

<table class="table-mahasiswa">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Lengkap</th>
            <th>Umur</th>
            <th>Tahun Masuk</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($students)): ?>
            <?php $no = 1; foreach ($students as $student): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($student['nim']); ?></td>
                    <td><?= esc($student['full_name']); ?></td>
                    <td><?= esc($student['age']); ?></td>
                    <td><?= esc($student['entry_year']); ?></td>
                    
                    <td class="action-buttons">
                        <?php if (session()->get('role') === 'admin'): ?>
                            <a href="<?= base_url('admin/students/' . $student['id'] . '/enroll'); ?>" class="btn btn-enroll">Ubah Matkul</a>
                            <a href="<?= base_url('admin/students/edit/' . $student['id']); ?>" class="btn btn-edit">Edit</a>
                            <a href="<?= base_url('admin/students/delete/' . $student['id']); ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                        <?php endif; ?>
                        
                        <?php 
                            $detailUrl = (session()->get('role') === 'admin') 
                                ? base_url('admin/students/detail/' . $student['id']) 
                                : base_url('dashboard/detail');
                        ?>
                        <a href="<?= $detailUrl; ?>" class="btn btn-detail">Detail</a>
                    </td>

                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px;">
                    <?= !empty($keyword) ? 'Tidak ada hasil pencarian untuk "' . esc($keyword) . '"' : 'Belum ada data mahasiswa.'; ?>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<style>
.table-mahasiswa { width: 100%; border-collapse: collapse; margin: 20px 0; }
.table-mahasiswa th, .table-mahasiswa td { border: 1px solid #ddd; padding: 12px; text-align: left; vertical-align: middle; }
.table-mahasiswa th { background-color: #ecf0f1; color: #2c3e50; }

/* === PERBAIKAN UTAMA ADA DI SINI === */
.action-buttons {
    display: flex;       /* Mengaktifkan Flexbox */
    flex-wrap: wrap;     /* Memastikan tombol turun ke bawah jika tidak cukup ruang */
    gap: 5px;            /* Memberi jarak 5px antar tombol */
    align-items: center; /* Menjaga tombol tetap sejajar di tengah */
}

/* Penyeragaman style tombol */
.btn {
    padding: 6px 12px;
    text-decoration: none;
    border-radius: 4px;
    font-size: 13px;
    color: white;
    text-align: center;
    display: inline-block;
    border: none;
}
.btn-enroll { background-color: #17a2b8; }
.btn-edit { background-color: #ffc107; color: #212529; }
.btn-delete { background-color: #dc3545; }
.btn-detail { background-color: #6c757d; }
</style>

<?= $this->endSection(); ?>