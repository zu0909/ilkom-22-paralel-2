<!DOCTYPE html>
<html>
<head> 
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        

        .logo {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }

        .logo img {
            width: 100%;
            height: 100%;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            width: 300px;
        }

        input[type="text"], input[type="password"] {
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background-color: #111;
            color: #fff;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="row justify-content-center" style="margin-top:100px">
            <div class="col-md-4 col-md-offset-4">
                <h4 class="text-center">Sign Up</h4><hr>
                <form action="<?= site_url('auth/save'); ?>" method="post">
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
                        <input type="text" class="form-control" name="username" placeholder="Enter your name" value="<?php set_value('username"'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'username"') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter your email" value="<?php set_value('email'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" name="password" placeholder="Enter password" value="<?php set_value('password'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input type="text" class="form-control" name="CPassword" placeholder="Enter Confirm Password" value="<?php set_value('CPassword'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'CPassword') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Sign Up</button>
                    </div>
                    <br>
                    <a href="<?= site_url('auth') ?>">I alredy have acount, login now</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>