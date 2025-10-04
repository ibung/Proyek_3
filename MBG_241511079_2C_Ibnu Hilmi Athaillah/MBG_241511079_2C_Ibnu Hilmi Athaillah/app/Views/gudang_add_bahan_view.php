<?= $this->extend('template_view'); ?>

<?= $this->section('sidebar-menu'); ?>
    <li><a href="<?= site_url('gudang/dashboard'); ?>">Dashboard Stok</a></li>
    <li><a href="<?= site_url('gudang/bahan/new'); ?>" class="active">Tambah Bahan Baku</a></li>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <div class="form-container">
        <form action="<?= site_url('gudang/bahan/create'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
                <label for="nama">Nama Bahan Baku</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <input type="text" id="kategori" name="kategori" required>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" required>
            </div>
            <div class="form-group">
                <label for="satuan">Satuan (kg, liter, butir, dll)</label>
                <input type="text" id="satuan" name="satuan" required>
            </div>
            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk</label>
                <input type="date" id="tanggal_masuk" name="tanggal_masuk" required>
            </div>
            <div class="form-group">
                <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
                <input type="date" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Bahan</button>
                <a href="<?= site_url('gudang/dashboard'); ?>" class="btn" style="background-color: #6c757d;">Batal</a>
            </div>
        </form>
    </div>
    <style>
        .form-container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; }
        .form-group input, .form-group select { width: 100%; padding: 12px; border: 1px solid #ced4da; border-radius: 5px; box-sizing: border-box; }
        .form-actions { display: flex; gap: 10px; margin-top: 20px; }
        .btn { display: inline-block; padding: 12px 20px; border-radius: 5px; text-decoration: none; color: white; border: none; cursor: pointer; }
        .btn-primary { background-color: #007bff; }
    </style>
<?= $this->endSection(); ?>