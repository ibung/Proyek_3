<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard MBG'); ?></title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; background-color: #f8f9fa; color: #343a40; }
        .wrapper { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background-color: #343a40; color: white; position: fixed; height: 100%; }
        .sidebar-header { padding: 20px; text-align: center; border-bottom: 1px solid #495057; }
        .sidebar-header h3 { margin: 0; font-size: 1.5rem; }
        .sidebar-menu { list-style: none; padding: 20px 0; margin: 0;}
        .sidebar-menu li a { display: block; color: #adb5bd; padding: 15px 20px; text-decoration: none; transition: background-color 0.2s, color 0.2s; }
        .sidebar-menu li a:hover, .sidebar-menu li a.active { background-color: #495057; color: white; }
        .main-content { margin-left: 250px; width: calc(100% - 250px); }
        .header { background-color: white; padding: 15px 30px; border-bottom: 1px solid #dee2e6; display: flex; justify-content: space-between; align-items: center; }
        .header .user-info { font-weight: bold; }
        .header .logout-btn { background-color: #dc3545; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; }
        .content-area { padding: 30px; }
        .content-title { margin-top: 0; margin-bottom: 20px; font-size: 1.8rem; }
        table { width: 100%; border-collapse: collapse; background-color: white; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #dee2e6; }
        thead th { background-color: #e9ecef; }
        .status { padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; color: white; text-transform: capitalize; }
        .status-tersedia, .status-disetujui { background-color: #28a745; }
        .status-segera_kadaluarsa, .status-menunggu { background-color: #ffc107; color: #212529; }
        .status-kadaluarsa, .status-ditolak { background-color: #dc3545; }
    </style>
</head>
<body>
    <div class="wrapper">
        <nav class="sidebar">
            <div class="sidebar-header">
                <h3>Aplikasi MBG</h3>
            </div>
            <ul class="sidebar-menu">
                <?= $this->renderSection('sidebar-menu'); ?>
            </ul>
        </nav>

        <div class="main-content">
            <header class="header">
                <div class="user-info">
                    Selamat Datang, <?= esc(session()->get('name')); ?>!
                </div>
                <a href="<?= site_url('logout'); ?>" class="logout-btn">Logout</a>
            </header>
            <main class="content-area">
                <h1 class="content-title"><?= esc($title ?? 'Dashboard'); ?></h1>
                <?= $this->renderSection('content'); ?>
            </main>
        </div>
    </div>
</body>
</html>