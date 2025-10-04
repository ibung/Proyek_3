<?= $this->extend('template_view'); ?>

<?= $this->section('sidebar-menu'); ?>
    <li class="nav-item">
        <a class="nav-link px-3" href="<?= site_url('gudang/dashboard'); ?>">Dashboard Stok</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active px-3" href="#">Form Bahan Baku</a>
    </li>
    <li class="nav-item">
        <a class="nav-link px-3" href="<?= site_url('gudang/permintaan'); ?>">Proses Permintaan</a>
    </li>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <?php
        // logika untuk menentukan apakah ini form 'edit' atau 'tambah'
        $isEdit = isset($bahan);
        $formAction = $isEdit ? site_url('gudang/bahan/update/' . $bahan['id']) : site_url('gudang/bahan/create');
    ?>

    <div class="card">
        <div class="card-header">
            <h4><?= $isEdit ? 'Ubah Data Bahan Baku' : 'Tambah Bahan Baku Baru'; ?></h4>
        </div>
        <div class="card-body">
            <form action="<?= $formAction; ?>" method="post">
                <?= csrf_field(); ?>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Bahan Baku</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama', $bahan['nama'] ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?= old('kategori', $bahan['kategori'] ?? ''); ?>" required>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= old('jumlah', $bahan['jumlah'] ?? ''); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="satuan" class="form-label">Satuan (kg, liter, dll)</label>
                        <input type="text" class="form-control" id="satuan" name="satuan" value="<?= old('satuan', $bahan['satuan'] ?? ''); ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= old('tanggal_masuk', $bahan['tanggal_masuk'] ?? ''); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                        <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="<?= old('tanggal_kadaluarsa', $bahan['tanggal_kadaluarsa'] ?? ''); ?>" required>
                    </div>
                </div>

                <?php if ($isEdit): ?>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select">
                            <option value="tersedia" <?= ($bahan['status'] == 'tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                            <option value="segera_kadaluarsa" <?= ($bahan['status'] == 'segera_kadaluarsa') ? 'selected' : ''; ?>>Segera Kadaluarsa</option>
                            <option value="kadaluarsa" <?= ($bahan['status'] == 'kadaluarsa') ? 'selected' : ''; ?>>Kadaluarsa</option>
                        </select>
                    </div>
                <?php endif; ?>
                <hr>
                <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Update Data' : 'Simpan Data'; ?></button>
                <a href="<?= site_url('gudang/dashboard'); ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
<?= $this->endSection(); ?>