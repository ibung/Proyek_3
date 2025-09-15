<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<h3>Daftar Mahasiswa</h3>
<p>Berikut adalah daftar mahasiswa yang terdaftar di sistem SMA XYZ.</p>

<div style="margin: 20px 0; padding: 15px; background-color: #e8f4fd; border-radius: 5px; border-left: 4px solid #3498db;">
    <strong>Total Mahasiswa:</strong> <?= count($mahasiswa); ?> orang
</div>

<table class="table-mahasiswa">
    <thead>
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama Lengkap</th>
            <th>Umur</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($mahasiswa)): ?>
            <?php $no = 1; foreach($mahasiswa as $m): ?>
                <tr>
                    <td><?= esc($m['id']); ?></td>
                    <td><?= esc($m['nim']); ?></td>
                    <td><?= esc($m['nama']); ?></td>
                    <td><?= esc($m['umur']); ?> tahun</td>
                    <td>
                        <a href="<?= base_url('mhs/detail/' . esc($m['nim'])); ?>" class="btn-detail">
                            Detail
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center; color: #7f8c8d; font-style: italic;">
                    Belum ada data mahasiswa yang terdaftar
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div style="margin-top: 30px; text-align: center; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
    <h4>Informasi</h4>
    <p>Data mahasiswa diambil langsung dari database sistem.</p>
</div>

<?= $this->endSection(); ?>