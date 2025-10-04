<?= $this->extend('template_view'); ?>

<?= $this->section('sidebar-menu'); ?>
    <li class="nav-item"><a class="nav-link px-3" href="<?= site_url('gudang/dashboard'); ?>">Dashboard Stok</a></li>
    <li class="nav-item"><a class="nav-link px-3" href="<?= site_url('gudang/bahan/new'); ?>">Tambah Bahan Baku</a></li>
    <li class="nav-item"><a class="nav-link active px-3" href="<?= site_url('gudang/permintaan'); ?>">Proses Permintaan</a></li>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <?php if (session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div><?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?><div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div><?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Permintaan Perlu Diproses (Status: Menunggu)</h5>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordionMenunggu">
                <?php if (!empty($waiting_requests)): ?>
                    <?php foreach ($waiting_requests as $req): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $req['id']; ?>">
                                <div class="d-flex justify-content-between w-100 me-3">
                                    <span><strong>Menu:</strong> <?= esc($req['menu_makan']); ?></span>
                                    <span><strong>Pemohon:</strong> <?= esc($req['pemohon_nama']); ?></span>
                                </div>
                            </button></h2>
                            <div id="collapse-<?= $req['id']; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionMenunggu">
                                <div class="accordion-body">
                                    <ul class="list-group mb-3">
                                        <?php foreach($req['details'] as $detail): ?>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <?= esc($detail['nama_bahan']); ?>
                                                <span class="badge bg-info rounded-pill"><?= esc($detail['jumlah_diminta']); ?> <?= esc($detail['satuan']); ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <form action="<?= site_url('gudang/permintaan/approve/' . $req['id']); ?>" method="post" id="form-setujui-<?= $req['id']; ?>">
                                            <?= csrf_field(); ?>
                                            <button type="button" class="btn btn-success btn-sm btn-konfirmasi" 
                                                    data-form-id="form-setujui-<?= $req['id']; ?>"
                                                    data-title="Konfirmasi Persetujuan"
                                                    data-text="Anda yakin ingin MENYETUJUI permintaan untuk menu '<?= esc($req['menu_makan']); ?>'? Stok akan otomatis berkurang.">
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="<?= site_url('gudang/permintaan/reject/' . $req['id']); ?>" method="post" id="form-tolak-<?= $req['id']; ?>">
                                            <?= csrf_field(); ?>
                                            <button type="button" class="btn btn-danger btn-sm btn-konfirmasi"
                                                    data-form-id="form-tolak-<?= $req['id']; ?>"
                                                    data-title="Konfirmasi Penolakan"
                                                    data-text="Anda yakin ingin MENOLAK permintaan untuk menu '<?= esc($req['menu_makan']); ?>'?">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">Tidak ada permintaan yang perlu diproses.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Riwayat Permintaan Dapur</h5>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordionRiwayat">
                <?php if (!empty($history_requests)): ?>
                    <?php foreach ($history_requests as $req): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-history-<?= $req['id']; ?>">
                                <div class="d-flex justify-content-between w-100 me-3">
                                    <span><strong>Menu:</strong> <?= esc($req['menu_makan']); ?></span>
                                    <span><strong>Pemohon:</strong> <?= esc($req['pemohon_nama']); ?></span>
                                    <span>
                                        <?php
                                            $status_class = $req['status'] == 'disetujui' ? 'bg-success' : 'bg-danger';
                                        ?>
                                        <strong>Status:</strong> <span class="badge <?= $status_class; ?>"><?= esc($req['status']); ?></span>
                                    </span>
                                </div>
                            </button></h2>
                            <div id="collapse-history-<?= $req['id']; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionRiwayat">
                                <div class="accordion-body">
                                    <ul class="list-group">
                                        <?php foreach($req['details'] as $detail): ?>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <?= esc($detail['nama_bahan']); ?>
                                                <span class="badge bg-info rounded-pill"><?= esc($detail['jumlah_diminta']); ?> <?= esc($detail['satuan']); ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">Belum ada riwayat permintaan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>