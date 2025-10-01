<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login | Sistem Informasi Akademik</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', 'Arial', sans-serif; background-color: #f4f4f4; min-height: 100vh; display: flex; justify-content: center; align-items: center; position: relative; overflow: hidden; }
        .login-container { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px); border-radius: 12px; padding: 50px 40px; width: 380px; box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); border: 1px solid rgba(255, 255, 255, 0.18); text-align: center; }
        h2 { margin-bottom: 30px; color: #2c3e50; font-weight: 600; }
        .input-group { margin-bottom: 20px; }
        .input-group input { width: 100%; padding: 14px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; }
        button { width: 100%; padding: 14px; background-color: #3498db; color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 600; }
        .register-link { margin-top: 20px; font-size: 14px; }
        .register-link a { color: #3498db; text-decoration: none; }
        .alert { padding: 12px; margin-bottom: 20px; border-radius: 8px; color: #721c24; background: rgba(254, 226, 226, 0.9); border: 1px solid rgba(252, 129, 129, 0.3); font-weight: 500; }
        .alert.success { background-color: #d4edda; color: #155724; border-color: #c3e6cb; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Masuk Akun</h2>
        
        <?php if(session()->getFlashdata('error')):?>
            <div class="alert"><?= session()->getFlashdata('error') ?></div>
        <?php endif;?>
        <?php if(session()->getFlashdata('success')):?>
            <div class="alert success"><?= session()->getFlashdata('success') ?></div>
        <?php endif;?>

        <form action="<?= base_url('login/process') ?>" method="post">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>