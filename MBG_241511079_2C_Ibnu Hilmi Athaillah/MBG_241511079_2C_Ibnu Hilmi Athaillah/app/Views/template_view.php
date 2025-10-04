<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard MBG'); ?></title>
    
    <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; }
        .wrapper { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background-color: #343a40; color: white; position: fixed; height: 100%; }
        .sidebar-header { padding: 20px; text-align: center; border-bottom: 1px solid #495057; }
        .sidebar-header h3 { margin: 0; font-size: 1.5rem; }
        .sidebar-menu { padding: 0; margin: 0; }
        .sidebar-menu .nav-link { color: #adb5bd; border-radius: 0; }
        .sidebar-menu .nav-link:hover, .sidebar-menu .nav-link.active { background-color: #495057; color: white; }
        .main-content { margin-left: 250px; width: calc(100% - 250px); }
        .header { background-color: white; padding: 15px 30px; border-bottom: 1px solid #dee2e6; display: flex; justify-content: space-between; align-items: center; }
        .content-area { padding: 30px; }
        .content-title { margin-top: 0; margin-bottom: 20px; font-size: 1.8rem; }
    </style>
</head>
<body>
    <div class="wrapper">
        <nav class="sidebar">
            <div class="sidebar-header">
                <h3>Aplikasi MBG</h3>
            </div>
            <ul class="nav flex-column sidebar-menu">
                <?= $this->renderSection('sidebar-menu'); ?>
            </ul>
        </nav>

        <div class="main-content">
            <header class="header">
                <div class="user-info">
                    Selamat Datang, <strong><?= esc(session()->get('name')); ?></strong>!
                </div>
                <a href="<?= site_url('logout'); ?>" class="btn btn-danger btn-sm">Logout</a>
            </header>
            <main class="content-area">
                <h1 class="content-title"><?= esc($title ?? 'Dashboard'); ?></h1>
                <?= $this->renderSection('content'); ?>
            </main>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>