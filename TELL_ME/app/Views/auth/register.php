<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tellme</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/styleRegist.css') ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <img src="<?= base_url('images/Telmewq2.png') ?>" alt="Left Image" class="left-image">
    <h1>Regist</h1>
    <h2>Start TELLing ME what you like..</h2>

    <div class="wrapper">
        <form action="<?= site_url('auth/save'); ?>" method="post">
            <?= csrf_field(); ?>

            <!-- Display success message -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- Display error message -->
            <?php if (session()->getFlashdata('fail')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('fail') ?>
                </div>
            <?php endif; ?>

            <div class="input-box">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Username" required value="<?= set_value('username'); ?>">
                <i class='bx bx-user'></i>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'username') : '' ?></span>
            </div>

            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" required value="<?= set_value('email'); ?>">
                <i class='bx bx-envelope'></i>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
            </div>

            <div class="input-box">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Masukkan Password" required value="<?= set_value('password'); ?>">
                <i class='bx bx-lock'></i>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
            </div>

            <div class="input-box">
                <label for="CPassword">Confirm Password</label>
                <input type="password" name="CPassword" placeholder="Konfirmasi Password" required value="<?= set_value('CPassword'); ?>">
                <i class='bx bx-lock'></i>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'CPassword') : '' ?></span>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
        </form>

        <!-- Login link for users who already have an account -->
        <div class="login-link">
            <p>Already have an account? <a href="<?= site_url('auth/login') ?>">Login here</a></p>
        </div>
    </div>
</body>
</html>
