<?= $this->extend('template_view'); ?>

<?= $this->section('sidebar-menu'); ?>
    <li><a href="<?= site_url('gudang/dashboard'); ?>" class="active">Dashboard Stok</a></li>
    <li><a href="<?= site_url('gudang/bahan/new'); ?>">Tambah Bahan Baku</a></li>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <a href="<?= site_url('gudang/bahan/new'); ?>" class="btn btn-primary" style="margin-bottom: 20px;">+ Tambah Bahan Baru</a>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success'); ?>
        </div>
        <style>.alert-success { background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; }</style>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Bahan</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Tgl Kadaluarsa</th>
                <th>Status</th>
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
                            <span class="status status-<?= str_replace('_', '-', esc($bahan['status'])); ?>">
                                <?= esc(str_replace('_', ' ', $bahan['status'])); ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Belum ada data bahan baku.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?= $this->endSection(); ?>