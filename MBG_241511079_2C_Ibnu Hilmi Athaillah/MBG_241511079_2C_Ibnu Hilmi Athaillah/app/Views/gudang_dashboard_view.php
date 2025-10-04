<?= $this->extend('template_view'); ?>

<?= $this->section('sidebar-menu'); ?>
    <li class="nav-item">
        <a class="nav-link active px-3" href="<?= site_url('gudang/dashboard'); ?>">Dashboard Stok</a>
    </li>
    <li class="nav-item">
        <a class="nav-link px-3" href="<?= site_url('gudang/bahan/new'); ?>">Tambah Bahan Baku</a>
    </li>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <div class="mb-3">
        <a href="<?= site_url('gudang/bahan/new'); ?>" class="btn btn-primary">+ Tambah Bahan Baru</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Bahan</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Tgl Kadaluarsa</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($bahan_baku)): ?>
                            <?php $no = 1; foreach ($bahan_baku as $bahan): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= esc($bahan['nama']); ?></td>
                                    <td><?= esc($bahan['kategori']); ?></td>
                                    <td><?= esc($bahan['jumlah']); ?></td>
                                    <td><?= esc($bahan['satuan']); ?></td>
                                    <td><?= date('d M Y', strtotime($bahan['tanggal_kadaluarsa'])); ?></td>
                                    <td>
                                        <?php
                                            $status_class = 'bg-success';
                                            if ($bahan['status'] == 'segera_kadaluarsa') $status_class = 'bg-warning text-dark';
                                            if ($bahan['status'] == 'kadaluarsa') $status_class = 'bg-danger';
                                        ?>
                                        <span class="badge <?= $status_class; ?>"><?= esc(str_replace('_', ' ', $bahan['status'])); ?></span>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('gudang/bahan/edit/' . $bahan['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data bahan baku.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>