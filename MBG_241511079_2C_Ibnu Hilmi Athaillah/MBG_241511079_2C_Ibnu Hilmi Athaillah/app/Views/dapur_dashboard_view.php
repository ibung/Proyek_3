<?= $this->extend('template_view'); ?>

<?= $this->section('sidebar-menu'); ?>
    <li class="nav-item">
        <a class="nav-link active px-3" href="<?= site_url('dapur/dashboard'); ?>">Dashboard Dapur</a>
    </li>
    <li class="nav-item">
        <a class="nav-link px-3" href="#">Buat Permintaan Baru</a>
    </li>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    
    <div class="card mb-4">
        <div class="card-header">
            <h5>Bahan Baku Tersedia untuk Diminta</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nama Bahan</th>
                            <th>Kategori</th>
                            <th>Stok Tersedia</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($bahan_baku_tersedia)): ?>
                            <?php foreach ($bahan_baku_tersedia as $bahan): ?>
                                <tr>
                                    <td><?= esc($bahan['nama']); ?></td>
                                    <td><?= esc($bahan['kategori']); ?></td>
                                    <td><?= esc($bahan['jumlah']); ?> <?= esc($bahan['satuan']); ?></td>
                                    <td>
                                        <?php
                                            $status_class = ($bahan['status'] == 'segera_kadaluarsa') ? 'bg-warning text-dark' : 'bg-success';
                                        ?>
                                        <span class="badge <?= $status_class; ?>"><?= esc(str_replace('_', ' ', $bahan['status'])); ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Saat ini tidak ada bahan baku yang tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Riwayat Permintaan Anda</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tgl Masak</th>
                            <th>Menu Makanan</th>
                            <th>Jumlah Porsi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($riwayat_permintaan)): ?>
                            <?php $no = 1; foreach ($riwayat_permintaan as $item): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= date('d M Y', strtotime($item['tgl_masak'])); ?></td>
                                    <td><?= esc($item['menu_makan']); ?></td>
                                    <td><?= esc($item['jumlah_porsi']); ?></td>
                                    <td>
                                        <?php
                                            $status_class = 'bg-success';
                                            if ($item['status'] == 'menunggu') $status_class = 'bg-warning text-dark';
                                            if ($item['status'] == 'ditolak') $status_class = 'bg-danger';
                                        ?>
                                        <span class="badge <?= $status_class; ?>"><?= esc($item['status']); ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Anda belum pernah membuat permintaan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>