<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/Stylenotif.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo"></div>
            <div class="sidebar-item profile-icon">
                <i class="fas fa-user"></i>
                <span><a href="<?= base_url('/profile') ?>">Profile</a></span>
            </div>
            <div class="sidebar-item notifications-icon">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </div>
            <div class="sidebar-item messages-icon">
                <i class="fas fa-envelope"></i>
                <span><a href="<?= base_url('/messages') ?>">Messages</a></span>
            </div>
        </aside>
        <main class="main-content">
            <div class="notifications-header">
                <h2>Notifications</h2>
            </div>
            <div class="notifications-list">
                <?php if (!empty($notifications)): ?>
                    <?php foreach ($notifications as $notification): ?>
                        <div class="notification-item">
                            <p><?= $notification['message'] ?></p>
                            <small><?= $notification['time'] ?> ago</small>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No notifications available.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
