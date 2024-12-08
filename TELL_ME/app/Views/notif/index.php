<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/Stylenotif.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .main-content {
            flex: 1;
            padding: 20px;
            position: relative;
            background: url('<?= base_url("images/tekkw.png") ?>') no-repeat center center;
            background-size: cover; /* Memenuhi seluruh area */
            z-index: 1; /* Membawa konten ke atas */
        }

        /* Lapisan transparan untuk pengaturan opacity */
        .main-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Lapisan gelap dengan transparansi */
            z-index: 0; /* Di bawah konten utama */
        }

        .notifications-header, .notifications-list {
            position: relative; /* Supaya tetap di atas layer transparan */
            z-index: 1;
        }
    </style>
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
                <button onclick="window.location.href='<?= base_url('/profile') ?>'">
                    Profile
                </button>
            </div>
            <div class="sidebar-item notifications-icon active">
                <i class="fas fa-bell"></i>
                <button onclick="window.location.href='<?= base_url('/notifications') ?>'">
                    Notifications
                </button>
            </div>
            <div class="sidebar-item messages-icon">
                <i class="fas fa-envelope"></i>
                <button onclick="window.location.href='<?= base_url('/messages') ?>'">
                    Messages
                </button>
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
