<!DOCTYPE html>
<html>
<head>
    <title><?= isset($title) ? esc($title) : 'Website Kampus XYZ'; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { width: 800px; margin: 20px auto; border: 1px solid #ddd; background-color: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { padding: 20px; border-bottom: 1px solid #ddd; background-color: #2c3e50; color: white; }
        .footer { border-top: 1px solid #ddd; padding: 15px; background-color: #34495e; color: white; }
        .menu { border-bottom: 1px solid #ddd; padding: 10px; background-color: #ecf0f1; display: flex; justify-content: space-between; align-items: center; }
        .menu a { margin-right: 20px; text-decoration: none; color: #2c3e50; font-weight: bold; }
        .content { padding: 30px; min-height: 400px; text-align: left; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>WEBSITE KAMPUS XYZ</h2>
        <p>Sistem Informasi Akademik</p>
    </div>

    <div class="menu">
        <div>
            <a href="<?= base_url('home'); ?>">Home</a>
            
            <?php if (session()->get('role') === 'admin'): ?>
                <a href="<?= base_url('admin/students'); ?>">Kelola Mahasiswa</a>
            
            <?php elseif (session()->get('role') === 'mahasiswa'): ?>
                <a href="<?= base_url('dashboard/detail'); ?>">Profil Saya</a>
                <a href="<?= base_url('dashboard/courses'); ?>">Jadwal Saya</a>
            <?php endif; ?>
        </div>
        <div>
            <span style="margin-right: 15px; color: #333;">Halo, <strong><?= esc(session()->get('full_name')); ?></strong>!</span>
            <a href="<?= base_url('logout'); ?>">Logout</a>
        </div>
    </div>

    <div class="content">
        <?= $this->renderSection('content'); ?>
    </div>

    <div class="footer">
        <p>&copy; <?= date('Y'); ?> Sistem Informasi Akademik</p>
    </div>
</div>
</body>
</html>