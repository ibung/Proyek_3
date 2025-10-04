<?= $this->extend('template_view'); ?>

<?= $this->section('sidebar-menu'); ?>
    <li class="nav-item">
        <a class="nav-link px-3" href="<?= site_url('gudang/dashboard'); ?>">Dashboard Stok</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active px-3" href="<?= site_url('gudang/bahan/new'); ?>">Form Bahan Baku</a>
    </li>
    <li class="nav-item">
        <a class="nav-link px-3" href="<?= site_url('gudang/permintaan'); ?>">Proses Permintaan</a>
    </li>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form action="<?= isset($bahan['id']) ? site_url('gudang/bahan/update/' . $bahan['id']) : site_url('gudang/bahan/create'); ?>" method="post">
                <?= csrf_field(); ?>
                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Bahan</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama', $bahan['nama'] ?? ''); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?= old('kategori', $bahan['kategori'] ?? ''); ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= old('jumlah', $bahan['jumlah'] ?? ''); ?>" required min="0">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="satuan" class="form-label">Satuan (kg, butir, potong, dll)</label>
                        <input type="text" class="form-control" id="satuan" name="satuan" value="<?= old('satuan', $bahan['satuan'] ?? ''); ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= old('tanggal_masuk', $bahan['tanggal_masuk'] ?? ''); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                        <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="<?= old('tanggal_kadaluarsa', $bahan['tanggal_kadaluarsa'] ?? ''); ?>" required>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="<?= site_url('gudang/dashboard'); ?>" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</a>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection(); ?>