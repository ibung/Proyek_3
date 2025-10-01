<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<h3><?= esc($title); ?></h3>
<p>Kelola data master mata kuliah yang tersedia di sistem.</p>

<a href="<?= base_url('admin/courses/new'); ?>" class="btn-save" style="margin-bottom: 20px; display: inline-block;">➕ Tambah Mata Kuliah</a>

<?php if (session()->getFlashdata('success')): ?>
    <div id="success-alert" style="padding: 15px; margin-bottom: 20px; background-color: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; color: #155724;">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<table class="table-mahasiswa">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode MK</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Aksi</th>
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
                    <td class="action-buttons">
                        <a href="<?= base_url('admin/courses/edit/' . $course['id']); ?>" class="btn btn-edit">Edit</a>
                        
                        <a href="<?= base_url('admin/courses/delete/' . $course['id']); ?>" 
                           class="btn btn-delete js-delete-btn" 
                           data-name="<?= esc($course['course_name']); ?>">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center;">Belum ada data mata kuliah.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<style>
/* Style Anda yang sudah ada */
.table-mahasiswa { width: 100%; border-collapse: collapse; margin: 20px 0; }
.table-mahasiswa th, .table-mahasiswa td { border: 1px solid #ddd; padding: 12px; text-align: left; }
.table-mahasiswa th { background-color: #f2f2f2; }
.action-buttons { display: flex; gap: 5px; }
.btn, .btn-save { padding: 6px 12px; text-decoration: none; border-radius: 4px; color: white; text-align: center; border: none; cursor: pointer; }
.btn-save { background-color: #28a745; }
.btn-edit { background-color: #ffc107; color: #212529; }
.btn-delete { background-color: #dc3545; }

/* CSS untuk modal konfirmasi */
.modal-overlay {
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.6); display: flex;
    justify-content: center; align-items: center; z-index: 1000;
}
.modal-box {
    background: white; padding: 30px; border-radius: 8px;
    width: 400px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}
.modal-buttons { display: flex; justify-content: center; gap: 15px; margin-top: 25px; }
.modal-buttons .btn { border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold; }
.modal-buttons .btn-confirm-delete { background-color: #dc3545; color: white; }
.modal-buttons .btn-cancel-delete { background-color: #f0f0f0; color: #333; }
</style>

<script>
    // Script untuk menghilangkan notifikasi sukses
    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.transition = 'opacity 0.5s';
            successAlert.style.opacity = '0';
            setTimeout(() => successAlert.remove(), 500);
        }, 3500);
    }

    // Script untuk modal konfirmasi hapus
    const deleteButtons = document.querySelectorAll('.js-delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); 
            const courseName = event.target.getAttribute('data-name');
            const deleteUrl = event.target.href;
            showConfirmationModal(courseName, deleteUrl);
        });
    });

    function showConfirmationModal(name, url) {
        const modalHTML = `
            <div class="modal-overlay" id="deleteModal">
                <div class="modal-box">
                    <h4>Konfirmasi Hapus</h4>
                    <p>Anda yakin ingin menghapus mata kuliah <strong>${name}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="modal-buttons">
                        <button class="btn btn-cancel-delete">Batal</button>
                        <a href="${url}" class="btn btn-confirm-delete">Ya, Hapus</a>
                    </div>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', modalHTML);

        document.querySelector('.btn-cancel-delete').addEventListener('click', function() {
            document.getElementById('deleteModal').remove();
        });
    }
</script>

<?= $this->endSection(); ?>