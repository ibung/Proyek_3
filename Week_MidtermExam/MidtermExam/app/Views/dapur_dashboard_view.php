<?= $this->extend('template_view'); ?>

<?= $this->section('sidebar-menu'); ?>
    <li><a href="<?= site_url('dapur/dashboard'); ?>" class="active">Dashboard Permintaan</a></li>
    <?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Masak</th>
                <th>Menu Makanan</th>
                <th>Jumlah Porsi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($permintaan)): ?>
                <?php $no = 1; foreach ($permintaan as $item): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= date('d M Y', strtotime($item['tgl_masak'])); ?></td>
                        <td><?= esc($item['menu_makan']); ?></td>
                        <td><?= esc($item['jumlah_porsi']); ?></td>
                        <td>
                            <span class="status status-<?= esc($item['status']); ?>">
                                <?= esc($item['status']); ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Belum ada data permintaan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?= $this->endSection(); ?>