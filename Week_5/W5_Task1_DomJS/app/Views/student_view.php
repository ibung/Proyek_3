<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>

<h3><?= esc($title); ?></h3>
<p>Berikut adalah daftar mahasiswa yang terdaftar di sistem Kampus XYZ.</p>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert success" id="success-alert" style="padding: 15px; margin: 20px 0; background-color: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; color: #155724;">
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
                            <a href="<?= base_url('admin/students/delete/' . $student['id']); ?>" 
                            class="btn btn-delete js-delete-btn" 
                            data-name="<?= esc($student['full_name']); ?>">Hapus</a>
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

<style>
/* Style untuk latar belakang gelap (overlay) */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

/* Style untuk kotak dialog */
.modal-box {
    background: white;
    padding: 30px;
    border-radius: 8px;
    width: 400px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}
.modal-box h4 {
    margin-top: 0;
    margin-bottom: 15px;
    font-size: 20px;
}
.modal-box p {
    margin-bottom: 25px;
    color: #666;
}
.modal-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
}
.modal-buttons .btn {
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}
.modal-buttons .btn-confirm-delete {
    background-color: #dc3545; /* Merah */
    color: white;
}
.modal-buttons .btn-cancel-delete {
    background-color: #f0f0f0; /* Abu-abu */
    color: #333;
}
</style>

<script>
// 1. DOM Selector: Pilih SEMUA tombol yang punya class 'js-delete-btn'
const deleteButtons = document.querySelectorAll('.js-delete-btn');

// 2. Event Handling: Pasang "pendengar" di setiap tombol
deleteButtons.forEach(button => {
    button.addEventListener('click', function (event) {
        // Mencegah link langsung berjalan
        event.preventDefault(); 

        // Ambil nama dan URL dari data attribute
        const studentName = event.target.getAttribute('data-name');
        const deleteUrl = event.target.href;

        // Panggil fungsi untuk menampilkan modal
        showConfirmationModal(studentName, deleteUrl);
    });
});

/**
 * Fungsi untuk membuat dan menampilkan modal konfirmasi
 * @param {string} name - Nama mahasiswa yang akan dihapus
 * @param {string} url - URL tujuan untuk proses hapus
 */
function showConfirmationModal(name, url) {
    // 3. DOM Manipulation: Buat elemen modal dari nol menggunakan string HTML
    const modalHTML = `
        <div class="modal-overlay" id="deleteModal">
            <div class="modal-box">
                <h4>Konfirmasi Hapus</h4>
                <p>Anda yakin ingin menghapus data mahasiswa bernama <strong>${name}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                <div class="modal-buttons">
                    <button class="btn btn-cancel-delete">Batal</button>
                    <a href="${url}" class="btn btn-confirm-delete">Ya, Hapus</a>
                </div>
            </div>
        </div>
    `;

    // Sisipkan HTML modal ke dalam body
    document.body.insertAdjacentHTML('beforeend', modalHTML);

    // Tambahkan event listener untuk tombol "Batal"
    document.querySelector('.btn-cancel-delete').addEventListener('click', function() {
        document.getElementById('deleteModal').remove();
    });
}
</script>

<script>
    // 1. DOM Selector: Pilih elemen notifikasi sukses
    const successAlert = document.getElementById('success-alert');

    // 2. Cek apakah elemen notifikasi itu ada di halaman
    if (successAlert) {
        
        // Inilah bagian Asinkron-nya!
        // "Hai JavaScript, tolong jalankan fungsi ini SETELAH 3500 milidetik (3.5 detik),
        // dan jangan hentikan eksekusi kode lain selagi menunggu."
        setTimeout(function() {
            
            // 3. DOM Manipulation: Setelah 3.5 detik, lakukan ini
            
            // Tambahkan transisi agar fade-out terlihat mulus
            successAlert.style.transition = 'opacity 0.5s ease';
            
            // Ubah opacity menjadi 0 (menjadi transparan)
            successAlert.style.opacity = '0';
            
            // Kita tunggu lagi sebentar (500ms) setelah transisi selesai
            // sebelum benar-benar menghapus elemennya dari DOM
            setTimeout(function() {
                successAlert.remove();
            }, 500);

        }, 3500); // Waktu tunggu dalam milidetik
    }
</script>

<?= $this->endSection(); ?>