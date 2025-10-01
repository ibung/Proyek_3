<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Aplikasi Pemantauan Bahan Baku MBG</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', 'Arial', sans-serif; background-color: #f4f4f4; min-height: 100vh; display: flex; justify-content: center; align-items: center; }
        .login-container { background: white; border-radius: 12px; padding: 50px 40px; width: 100%; max-width: 380px; box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1); text-align: center; }
        h2 { margin-bottom: 30px; color: #2c3e50; font-weight: 600; }
        .input-group { margin-bottom: 20px; }
        .input-group input { width: 100%; padding: 14px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; }
        .input-group input:focus { outline: none; border-color: #3498db; }
        button { width: 100%; padding: 14px; background-color: #3498db; color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 600; transition: background-color 0.3s; }
        button:hover { background-color: #2980b9; }
        .alert { padding: 12px; margin-bottom: 20px; border-radius: 8px; color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; font-weight: 500; text-align: left; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Akun</h2>
        
        <?php if(session()->getFlashdata('error')):?>
            <div class="alert"><?= session()->getFlashdata('error') ?></div>
        <?php endif;?>

        <form action="<?= site_url('login/process') ?>" method="post">
            <?= csrf_field() ?>
            <div class="input-group">
                <input type="email" name="email" placeholder="Email" value="<?= old('email') ?>" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>