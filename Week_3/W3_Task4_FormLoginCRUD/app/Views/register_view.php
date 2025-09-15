<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="/register/save" method="post">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Daftar</button>
    </form>

    <?php if(session()->getFlashdata('msg')): ?>
        <p><?= session()->getFlashdata('msg') ?></p>
    <?php endif; ?>
</body>
</html>
