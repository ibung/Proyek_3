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

        /* CSS UNTUK MODAL KONFIRMASI */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        .modal-box {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }
        .modal-overlay.show .modal-box {
            transform: scale(1);
        }
        .modal-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
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

    <script>
    document.addEventListener('click', function(event) {
        if (event.target.matches('.btn-hapus')) {
            event.preventDefault();
            const button = event.target;
            const namaBahan = button.dataset.nama;
            const formId = button.dataset.formId;
            showDeleteModal(namaBahan, formId);
        }
    });

    function showDeleteModal(nama, formId) {
        const existingModal = document.getElementById('deleteModal');
        if (existingModal) {
            existingModal.remove();
        }

        const modalHTML = `
            <div class="modal-overlay" id="deleteModal">
                <div class="modal-box">
                    <h4>Konfirmasi Hapus</h4>
                    <p>Anda yakin ingin menghapus bahan baku <strong>${nama}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="modal-buttons">
                        <button class="btn btn-secondary" id="btn-batal-hapus">Batal</button>
                        <button class="btn btn-danger" id="btn-konfirmasi-hapus">Ya, Hapus</button>
                    </div>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', modalHTML);

        const modal = document.getElementById('deleteModal');
        setTimeout(() => modal.classList.add('show'), 10);

        document.getElementById('btn-batal-hapus').addEventListener('click', function() {
            modal.classList.remove('show');
            setTimeout(() => modal.remove(), 300);
        });

        document.getElementById('btn-konfirmasi-hapus').addEventListener('click', function() {
            document.getElementById(formId).submit();
        });
    }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const allAlerts = document.querySelectorAll('.alert');

            allAlerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    
                    setTimeout(function() {
                        alert.remove();
                    }, 500);

                }, 3000);
            });
        });
    </script>
</body>
</html>