<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
</head>
<body>
    <h1>Detail Data Mahasiswa</h1>

    <?php if (!empty($mahasiswa)): ?>
        <p><b>ID:</b> <?= esc($mahasiswa['id']) ?></p>
        <p><b>NIM:</b> <?= esc($mahasiswa['nim']) ?></p>
        <p><b>Nama:</b> <?= esc($mahasiswa['nama']) ?></p>
        <p><b>Umur:</b> <?= esc($mahasiswa['umur']) ?></p>
    <?php else: ?>
        <p>Data mahasiswa tidak ditemukan.</p>
    <?php endif; ?>

    <br>
    <a href="<?= base_url('mhs') ?>">← Kembali ke Daftar</a>
</body>
</html>
