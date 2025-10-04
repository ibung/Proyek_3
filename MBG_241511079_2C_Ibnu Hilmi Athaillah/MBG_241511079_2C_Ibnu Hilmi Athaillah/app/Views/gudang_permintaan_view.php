<?= $this->extend('template_view'); ?>

<?= $this->section('sidebar-menu'); ?>
    <li class="nav-item">
        <a class="nav-link px-3" href="<?= site_url('gudang/dashboard'); ?>">Dashboard Stok</a>
    </li>
    <li class="nav-item">
        <a class="nav-link px-3" href="<?= site_url('gudang/bahan/new'); ?>">Tambah Bahan Baku</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active px-3" href="<?= site_url('gudang/permintaan'); ?>">Status Permintaan</a>
    </li>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <div class="card">
        <div class="card-header">
            <h5>Permintaan Bahan dari Dapur (Status: Menunggu)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal Minta</th>
                            <th>Pemohon (Dapur)</th>
                            <th>Menu</th>
                            <th>Jumlah Porsi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($requests)): ?>
                            <?php foreach ($requests as $req): ?>
                                <tr>
                                    <td><?= date('d M Y H:i', strtotime($req['created_at'])); ?></td>
                                    <td><?= esc($req['pemohon_nama']); ?></td>
                                    <td><?= esc($req['menu_makan']); ?></td>
                                    <td><?= esc($req['jumlah_porsi']); ?></td>
                                    <td>
                                        <span class="badge bg-warning text-dark"><?= esc($req['status']); ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada permintaan yang sedang menunggu.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>