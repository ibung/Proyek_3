<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>
    <table border='1' cellpadding='5'>
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Umur</th>
            <th>View Detail</th>
        </tr>
        <?php if (!empty($mahasiswa)): ?>
            <?php foreach ($mahasiswa as $m): ?>
            <tr>
                <td><?= esc($m['id']) ?></td>
                <td><?= esc($m['nim']) ?></td>
                <td><?= esc($m['nama']) ?></td>
                <td><?= esc($m['umur']) ?></td>
                <td>
                    <a href="<?= base_url('mhs/detail/' . $m['id']) ?>">View Detail</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Belum ada data mahasiswa</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
