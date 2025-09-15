<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<h3>Daftar Mahasiswa</h3>
<p>Berikut adalah daftar mahasiswa yang terdaftar di sistem SMA XYZ.</p>

<!-- Flash Messages -->
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

<?php if (session()->getFlashdata('errors')): ?>
    <div style="padding: 15px; margin: 20px 0; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; color: #721c24;">
        <strong>Terjadi kesalahan:</strong>
        <ul style="margin: 10px 0 0 20px;">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Search Form -->
<div style="margin: 20px 0;">
    <form method="GET" action="<?= base_url('mhs'); ?>" style="display: flex; gap: 10px; align-items: center;">
        <input type="text" name="search" value="<?= esc($keyword); ?>" placeholder="Cari berdasarkan nama atau NIM..." 
               style="padding: 8px 15px; border: 1px solid #ddd; border-radius: 4px; width: 250px;">
        <button type="submit" style="padding: 8px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Cari
        </button>
        <?php if (!empty($keyword)): ?>
            <a href="<?= base_url('mhs'); ?>" style="padding: 8px 15px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px;">
                Reset
            </a>
        <?php endif; ?>
    </form>
</div>

<!-- Add New Student Form -->
<div style="margin: 20px 0; padding: 20px; background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #28a745;">
    <h4 style="color: #28a745; margin-bottom: 15px;">
        <?= isset($editData) && $editData ? 'Edit Mahasiswa' : 'Tambah Mahasiswa Baru'; ?>
    </h4>
    
    <form method="POST" action="<?= isset($editData) && $editData ? base_url('mhs/update') : base_url('mhs/create'); ?>">
        <?php if (isset($editData) && $editData): ?>
            <input type="hidden" name="id" value="<?= $editData['id']; ?>">
        <?php endif; ?>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 15px;">
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">NIM:</label>
                <input type="text" name="nim" required 
                       value="<?= isset($editData) && $editData ? esc($editData['nim']) : old('nim'); ?>"
                       style="width: 95%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nama Lengkap:</label>
                <input type="text" name="nama" required 
                       value="<?= isset($editData) && $editData ? esc($editData['nama']) : old('nama'); ?>"
                       style="width: 95%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Umur:</label>
                <input type="number" name="umur" required min="1" max="150"
                       value="<?= isset($editData) && $editData ? esc($editData['umur']) : old('umur'); ?>"
                       style="width: 95%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
        </div>
        
        <div>
            <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; margin-right: 10px;">
                <?= isset($editData) && $editData ? 'Update Data' : 'Tambah Data'; ?>
            </button>
            
            <?php if (isset($editData) && $editData): ?>
                <a href="<?= base_url('mhs'); ?>" style="padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px;">
                    Batal Edit
                </a>
            <?php endif; ?>
        </div>
    </form>
</div>

<div style="margin: 20px 0; padding: 15px; background-color: #e8f4fd; border-radius: 5px; border-left: 4px solid #3498db;">
    <strong>Total Mahasiswa:</strong> <?= count($mahasiswa); ?> orang
    <?php if (!empty($keyword)): ?>
        <span style="margin-left: 20px; color: #666;">
            (Hasil pencarian: "<?= esc($keyword); ?>")
        </span>
    <?php endif; ?>
</div>

<table class="table-mahasiswa">
    <thead>
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama Lengkap</th>
            <th>Umur</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($mahasiswa)): ?>
            <?php $no = 1; foreach($mahasiswa as $m): ?>
                <tr>
                    <td><?= esc($m['id']); ?></td>
                    <td><?= esc($m['nim']); ?></td>
                    <td><?= esc($m['nama']); ?></td>
                    <td><?= esc($m['umur']); ?> tahun</td>
                    <td>
                        <a href="<?= base_url('mhs/detail/' . esc($m['nim'])); ?>" class="btn-detail">
                            Detail
                        </a>
                        <a href="<?= base_url('mhs/edit/' . esc($m['id'])); ?>" class="btn-edit">
                            Edit
                        </a>
                        <a href="<?= base_url('mhs/delete/' . esc($m['id'])); ?>" class="btn-delete"
                           onclick="return confirm('Apakah Anda yakin ingin menghapus data <?= esc($m['nama']); ?>?');">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center; color: #7f8c8d; font-style: italic; padding: 20px;">
                    <?= !empty($keyword) ? 'Tidak ada hasil pencarian untuk "' . esc($keyword) . '"' : 'Belum ada data mahasiswa yang terdaftar'; ?>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div style="margin-top: 30px; text-align: center; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
    <h4>INFORMASI</h4>
    <p>Data mahasiswa diambil langsung dari database sistem. Anda dapat menambah, mengubah, atau menghapus data mahasiswa melalui halaman ini.</p>
</div>

<style>
.btn-edit {
    background-color: #ffc107;
    color: #212529;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 3px;
    font-size: 12px;
    margin-right: 5px;
}

.btn-delete {
    background-color: #dc3545;
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 3px;
    font-size: 12px;
    margin-right: 5px;
}

.btn-detail {
    background-color: #17a2b8;
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 3px;
    font-size: 12px;
    margin-right: 5px;
}

.btn-edit:hover, .btn-delete:hover, .btn-detail:hover {
    opacity: 0.8;
}
</style>

<?= $this->endSection(); ?>