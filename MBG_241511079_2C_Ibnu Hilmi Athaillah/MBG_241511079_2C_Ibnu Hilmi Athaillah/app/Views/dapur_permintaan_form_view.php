<?= $this->extend('template_view'); ?>

<?= $this->section('sidebar-menu'); ?>
    <li class="nav-item">
        <a class="nav-link px-3" href="<?= site_url('dapur/dashboard'); ?>">Dashboard Dapur</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active px-3" href="<?= site_url('dapur/permintaan/new'); ?>">Buat Permintaan Baru</a>
    </li>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <form action="<?= site_url('dapur/permintaan/create'); ?>" method="post">
        <?= csrf_field(); ?>
        <div class="card">
            <div class="card-header">
                <h5>Formulir Permintaan Bahan Baku</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="menu_makan" class="form-label">Nama Menu Masakan</label>
                        <input type="text" class="form-control" id="menu_makan" name="menu_makan" value="<?= old('menu_makan'); ?>" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="tgl_masak" class="form-label">Tanggal Masak</label>
                        <input type="date" class="form-control" id="tgl_masak" name="tgl_masak" value="<?= old('tgl_masak', date('Y-m-d')); ?>" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="jumlah_porsi" class="form-label">Jumlah Porsi</label>
                        <input type="number" class="form-control" id="jumlah_porsi" name="jumlah_porsi" value="<?= old('jumlah_porsi'); ?>" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="created_at" class="form-label">Tanggal Permintaan</label>
                        <input type="date" class="form-control" id="created_at" name="created_at" value="<?= old('created_at', date('Y-m-d')); ?>" required>
                    </div>
                </div>
                
                <hr>
                
                <h6>Bahan yang Dibutuhkan</h6>
                <div class="row align-items-end mb-3">
                    <div class="col-md-6">
                        <label for="bahan-select" class="form-label">Pilih Bahan Baku</label>
                        <select id="bahan-select" class="form-select">
                            <option value="">-- Pilih Bahan --</option>
                            <?php foreach($bahan_list as $bahan): ?>
                                <option value="<?= $bahan['id']; ?>" data-nama="<?= esc($bahan['nama']); ?>" data-satuan="<?= esc($bahan['satuan']); ?>">
                                    <?= esc($bahan['nama']); ?> (Stok: <?= $bahan['jumlah']; ?> <?= esc($bahan['satuan']); ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" id="tambah-bahan-btn" class="btn btn-info">Tambah ke Daftar</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Bahan</th>
                                <th>Jumlah Dibutuhkan</th>
                                <th>Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="daftar-bahan-diminta">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="<?= site_url('dapur/dashboard'); ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('tambah-bahan-btn');
            const bahanSelect = document.getElementById('bahan-select');
            const daftarBahan = document.getElementById('daftar-bahan-diminta');

            addBtn.addEventListener('click', function() {
                const selectedOption = bahanSelect.options[bahanSelect.selectedIndex];
                if (!selectedOption.value) return;

                const bahanId = selectedOption.value;
                const bahanNama = selectedOption.getAttribute('data-nama');
                const bahanSatuan = selectedOption.getAttribute('data-satuan');

                if (document.getElementById(`item-${bahanId}`)) {
                    alert('Bahan ini sudah ada di dalam daftar.');
                    return;
                }

                const newRow = `
                    <tr id="item-${bahanId}">
                        <td>
                            ${bahanNama}
                            <input type="hidden" name="bahan_id[]" value="${bahanId}">
                        </td>
                        <td>
                            <input type="number" name="jumlah_diminta[]" class="form-control" required min="1">
                        </td>
                        <td>${bahanSatuan}</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="document.getElementById('item-${bahanId}').remove()">Hapus</button>
                        </td>
                    </tr>
                `;
                daftarBahan.insertAdjacentHTML('beforeend', newRow);
            });
        });
    </script>
<?= $this->endSection(); ?>