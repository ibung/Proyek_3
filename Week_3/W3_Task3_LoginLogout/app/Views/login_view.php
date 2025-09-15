<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login | Sistem Informasi Akademik</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body { 
            font-family: 'Inter', 'Arial', sans-serif; 
            background-color: #f4f4f4;
            min-height: 100vh; 
            display: flex; 
            justify-content: center; 
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        /* body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="1" fill="white" opacity="0.05"/><circle cx="90" cy="50" r="1" fill="white" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            z-index: 1;
        } */
        
        .login-container { 
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15), 
                        0 0 0 1px rgba(255,255,255,0.2);
            width: 400px;
            text-align: center;
            position: relative;
            z-index: 2;
            border: 1px solid rgba(255,255,255,0.3);
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(145deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            border-radius: 20px;
            z-index: -1;
        }
        
        .login-container h2 { 
            margin-bottom: 35px; 
            color: #2d3748; 
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 25px;
        }
        
        .login-container input { 
            width: 100%; 
            padding: 16px 20px; 
            border: 2px solid rgba(226, 232, 240, 0.8);
            border-radius: 12px; 
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            outline: none;
        }
        
        .login-container input:focus {
            border-color: #667eea;
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }
        
        .login-container input::placeholder {
            color: #a0aec0;
            font-weight: 500;
        }
        
        .login-container button { 
            width: 100%; 
            padding: 16px; 
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: #fff; 
            border: none; 
            border-radius: 12px; 
            cursor: pointer; 
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
            margin-top: 10px;
        }
        
        .login-container button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(102, 126, 234, 0.4);
        }
        
        .login-container button:active {
            transform: translateY(0);
        }
        
        .alert { 
            padding: 16px 20px; 
            margin-bottom: 25px; 
            border-radius: 12px; 
            color: #e53e3e; 
            background: rgba(254, 226, 226, 0.9);
            border: 1px solid rgba(252, 129, 129, 0.3);
            font-weight: 500;
            backdrop-filter: blur(5px);
        }
        
        .system-title {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            z-index: 3;
        }
        
        @media (max-width: 480px) {
            .login-container {
                width: 90%;
                padding: 40px 30px;
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="system-title">Sistem Informasi Akademik</div>
    
    <div class="login-container">
        <h2>Masuk Akun</h2>

        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>

        <form action="<?= base_url('login/process') ?>" method="post">
            <div class="input-group">
                <input type="text" name="username" placeholder="Nama Pengguna" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Kata Sandi" required>
            </div>
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>