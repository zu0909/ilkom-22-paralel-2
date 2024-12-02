<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tellme</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/styleRegist.css') ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <img src="<?= base_url('images/Telmewq2.png') ?>" alt="Left Image" class="left-image">
    <h1 class="text-center">Regist</h1>
    <h2 class="text-center">Start TELLing ME what you like..</h2>

    <div class="container">
        <div class="row justify-content-center" style="margin-top:100px">
            <div class="col-md-4 col-md-offset-4">
                <h4 class="text-center">Sign Up</h4><hr>
                <form action="<?= site_url('auth/regist') ?>" method="post">
                    <?= csrf_field(); ?>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('fail')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('fail') ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="username">User name</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter your name" value="<?php set_value('username'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'username') : '' ?></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?php set_value('email'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password" value="<?php set_value('password'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                    </div>

                    <div class="form-group">
                        <label for="CPassword">Confirm Password</label>
                        <input type="password" class="form-control" name="CPassword" placeholder="Confirm Password" value="<?php set_value('CPassword'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'CPassword') : '' ?></span>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Sign Up</button>
                    </div>

                    <br>
                    <a href="<?= site_url('auth') ?>">I already have an account, login now</a>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
