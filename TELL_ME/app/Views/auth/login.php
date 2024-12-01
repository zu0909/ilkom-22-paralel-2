<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tellme</title>
    <link rel="stylesheet" href="<?= base_url('css/styleLogin.css') ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <img src="<?= base_url('images/bitmap.png') ?>" class="login-image">
    <img src="<?= base_url('images/Telmewq2.png') ?>" alt="Left Image" class="left-image">
    <h1>Login</h1>
    <h2>Tell everything you want.</h2>

    <div class="wrapper">
        <form action="<?= site_url('auth/login') ?>" method="post">
            
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bx-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Masukkan Password" required>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Ingat Saya</label>
                <a href="<?= site_url('/forgot-password') ?>">Lupa Password?</a>
            </div>
            <button type="submit" class="btn">Masuk</button>
        </form>
        <div class="link">
            <p>Belum punya akun? <a href="<?= site_url('auth/register') ?>">Sign up</a></p>
        </div>
    </div>
</body>
</html>
