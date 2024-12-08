<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/Stylenotif.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <img src="<?= base_url('images/logoo.png') ?>" alt="Logo">
            </div>
            <div class="sidebar-item profile-icon">
                <i class="fas fa-user"></i>
                <button class="profile-button" onclick="window.location.href='<?= base_url('/profile') ?>'">
                    <span>Profile</span>
                </button>
            </div>
            <div class="sidebar-item notifications-icon active">
                <i class="fas fa-bell"></i>
                <button class="notifications-button" onclick="window.location.href='<?= base_url('/notifications') ?>'">
                    <span>Notifications</span>
                </button>
            </div>
            <div class="sidebar-item messages-icon">
                <i class="fas fa-envelope"></i>
                <span>Messages</span>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="notifications-header">
                <h2>Notifications</h2>
            </div>
            <div class="notifications-list">
                <?php if (!empty($notifications)): ?>
                    <?php foreach ($notifications as $notification): ?>
                        <div class="notification-item">
                            <p><?= esc($notification['message']) ?></p>
                            <small><?= esc($notification['time']) ?> ago</small>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-notifications">No notifications available.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
