<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tellme</title>
    <link rel="stylesheet" href="<?= base_url('css/styleRegist.css') ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <img src="<?= base_url('images/Telmewq2.png') ?>" alt="Left Image" class="left-image">
    <h1>Regist</h1>
    <h2>Start TELLing ME what you like..</h2>

    <div class="wrapper">
        <form action="<?= site_url('auth/regist') ?>" method="post">
            
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bx-user'></i>
            </div>

            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class='bx bx-envelope'></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Masukkan Password" required>
                <i class='bx bx-lock'></i>
            </div>

            <div class="input-box">
                <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
                <i class='bx bx-lock'></i>
            </div>
            
            
            <button type="submit" class="btn">Daftar</button>
        </form>
    
    </div>
</body>
</html>
