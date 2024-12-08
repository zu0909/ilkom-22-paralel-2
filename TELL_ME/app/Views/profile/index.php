<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/styleProfile.css') ?>">
</head>
<body>
    <div class="profile-container">
        <h1>Welcome, <?= esc($username) ?>!</h1>
        <p>Email: <?= esc($email) ?></p>
        <a href="<?= base_url('/auth/ds') ?>">Back to Home</a>
    </div>
</body>
</html>
