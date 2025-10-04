<?= $this->extend('template_view'); ?>

<?= $this->section('sidebar-menu'); ?>
    <li class="nav-item">
        <a class="nav-link active px-3" href="<?= site_url('dapur/dashboard'); ?>">Dashboard Dapur</a>
    </li>
    <li class="nav-item">
        <a class="nav-link px-3" href="<?= site_url('dapur/permintaan/new'); ?>">Buat Permintaan Baru</a>
    </li>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    
    <?php if (session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div><?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?><div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div><?php endif; ?>

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
            <div class="accordion" id="accordionRiwayat">
                <?php if (!empty($riwayat_permintaan)): ?>
                    <?php foreach ($riwayat_permintaan as $item): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-riwayat-<?= $item['id']; ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-riwayat-<?= $item['id']; ?>">
                                    <div class="d-flex justify-content-between w-100 me-3">
                                        <span><strong>Menu:</strong> <?= esc($item['menu_makan']); ?> (<?= date('d M Y', strtotime($item['tgl_masak'])); ?>)</span>
                                        <span>
                                            <?php
                                                $status_class = 'bg-success';
                                                if ($item['status'] == 'menunggu') $status_class = 'bg-warning text-dark';
                                                if ($item['status'] == 'ditolak') $status_class = 'bg-danger';
                                            ?>
                                            <strong>Status:</strong> <span class="badge <?= $status_class; ?>"><?= esc($item['status']); ?></span>
                                        </span>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse-riwayat-<?= $item['id']; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionRiwayat">
                                <div class="accordion-body">
                                    <h6>Detail Bahan yang Diminta:</h6>
                                    <ul class="list-group">
                                        <?php if (!empty($item['details'])): ?>
                                            <?php foreach($item['details'] as $detail): ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?= esc($detail['nama_bahan']); ?>
                                                    <span class="badge bg-info rounded-pill"><?= esc($detail['jumlah_diminta']); ?> <?= esc($detail['satuan']); ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li class="list-group-item">Tidak ada detail bahan untuk permintaan ini.</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">Anda belum pernah membuat permintaan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>