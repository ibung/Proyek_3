<!DOCTYPE html>
<html>
<head>
    <title><?= isset($title) ? $title : 'Website SMA XYZ'; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { 
            font-family: Arial, sans-serif; 
            text-align: center; 
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container { 
            width: 800px; 
            margin: 20px auto; 
            border: 1px solid #ddd; 
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header { 
            padding: 20px; 
            border-bottom: 1px solid #ddd; 
            background-color: #2c3e50;
            color: white;
        }
        .footer { 
            border-top: 1px solid #ddd; 
            padding: 15px;
            background-color: #34495e;
            color: white;
        }
        .menu {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            background-color: #ecf0f1;

            display: flex;
            justify-content: space-between; /* kiri - kanan */
            align-items: center;
        }

        .menu a {
            margin-right: 20px;
            text-decoration: none;
            color: #2c3e50;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .menu a:hover {
            background-color: #bdc3c7;
        }

        /* biar Logout gak ketiban margin kanan */
        .menu .logout {
            margin-right: 0;
            background-color: #e74c3c;
            color: #fff;
        }

        .menu .logout:hover {
            background-color: #c0392b;
        }
        
        .content { 
            padding: 30px; 
            min-height: 400px;
            text-align: left;
        }
        .table-mahasiswa { 
            width: 100%;
            border-collapse: collapse; 
            margin: 20px 0;
        }
        .table-mahasiswa th, .table-mahasiswa td { 
            border: 1px solid #ddd; 
            padding: 10px; 
            text-align: left;
        }
        .table-mahasiswa th {
            background-color: #3498db;
            color: white;
        }
        .table-mahasiswa tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn-detail, .btn-kembali {
            background-color: #3498db;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 12px;
            transition: background-color 0.3s;
        }
        .btn-detail:hover, .btn-kembali:hover {
            background-color: #2980b9;
        }
        .btn-kembali {
            background-color: #95a5a6;
            display: inline-block;
            margin-top: 20px;
        }
        .btn-kembali:hover {
            background-color: #7f8c8d;
        }
        .detail-box {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 5px;
            border-left: 4px solid #3498db;
            margin: 20px 0;
        }
        .detail-box p {
            margin: 10px 0;
            font-size: 16px;
        }
        .welcome-box {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin: 20px 0;
            text-align: center;
        }
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        .feature-card {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #3498db;
            text-align: center;
        }
        .feature-card h4 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="header">
        <h2>WEBSITE SMA XYZ</h2>
        <p>Sistem Informasi Akademik</p>
    </div>

    <!-- Menu -->
    <div class="menu">
        <a href="<?= base_url('home'); ?>">Home</a>
        <a href="<?= base_url('mhs'); ?>">Data Mahasiswa</a>
        <a href="<?= base_url('/logout'); ?>" 
        class="btn btn-danger d-flex align-items-center gap-2 px-4 py-2 rounded-pill shadow-sm" 
        style="transition: all 0.3s ease;">
        <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

    <!-- Konten -->
    <div class="content">
        <?= $this->renderSection('content'); ?>
    </div>

    <!-- Footer -->
    <div class="footer">
        <b>SMA XYZ</b><br>
        <small>&copy; Ibnu Hilmi Athaillah</small>
    </div>
</div>
</body>
</html>