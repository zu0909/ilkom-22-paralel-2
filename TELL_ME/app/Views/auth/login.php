<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .login-container {
            text-align: center;
        }

        .login-container img {
            width: 100px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .input-field {
            background: none;
            border: 1px solid #555;
            padding: 10px;
            width: 100%;
            max-width: 300px;
            margin-bottom: 1rem;
            color: #fff;
            border-radius: 5px;
        }

        .btn {
            background-color: #666;
            padding: 10px 20px;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            max-width: 300px;
        }

        .btn:hover {
            background-color: #888;
        }

        .links {
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        .links a {
            color: #ccc;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <img src="/bootstrap/logo1.jpeg" alt="Logo">
    <h5 style="margin-top: 1px;">Tell Everything you want</h5>
    <h2>TELL ME</h2>
    <form action="<?= site_url('auth/login') ?>" method="post">
    <input type="text" name="username" class="input-field" placeholder="Username" required>
    <input type="password" name="password" class="input-field" placeholder="Password" required>
    <button type="submit" class="btn">Sign In</button>
    </form>

    <div class="links">
    <p>Don't have an account? <a href="<?= site_url('auth/register') ?>">Create an account</a></p>
    <p><a href="<?= site_url('/forgot-password') ?>">Forgot password?</a></p>
</div>
</div>

</body>
</html>
