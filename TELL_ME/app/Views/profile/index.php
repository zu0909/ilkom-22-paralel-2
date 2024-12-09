<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($username) ?>'s Profile</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/Styleprofile.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo"></div>
            <div class="sidebar-item profile-icon">
                <i class="fas fa-user"></i>
                <button onclick="window.location.href='<?= base_url('/profile/index') ?>'">
                    Profile
                </button>
            </div>
            <div class="sidebar-item notifications-icon">
                <i class="fas fa-bell"></i>
                <button onclick="window.location.href='<?= base_url('/notif/index') ?>'">
                    Notification
                </button>
            </div>
            <div class="sidebar-item home-icon">
                <i class="fas fa-home"></i>
                <button onclick="window.location.href='<?= base_url('auth/ds') ?>'">
                    Home
                </button>
            </div>
        </aside>
        <main class="main-content">
        <div class="profile-header">
            <div class="profile-avatar">
                <?php if (!empty(session()->get('profile_picture'))): ?>
                <img src="<?= esc(session()->get('profile_picture')) ?>" alt="Profile Picture">
                <?php else: ?>
                    <img src="default-avatar.png" alt="Default Avatar"> <!-- Gambar default jika tidak ada -->
                <?php endif; ?>
            </div>
            <div class="profile-info">
                <h2 class="profile-name"><?= esc(session()->get('username')) ?></h2>
                <p class="profile-bio"><?= esc(session()->get('bio')) ?></p>
                <div class="profile-stats">
                    <span id="follower-count">Followers: <?= esc($followersCount) ?></span>
                </div>
            </div>
                <div class="profile-actions">
                    <button class="btn chat-btn">Chat</button>
                    <a href="<?= base_url('/profile/edit') ?>" class="btn edit-profile-btn">Edit Profile</a>
                    <button class="btn follow-btn">Follow</button>
                </div>
            </div>
            <div class="profile-posts">
                <h3>Recent Posts</h3>
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                    <div class="post" data-id="<?= esc($post['id']) ?>">
                        <div class="post-header">
                            <div class="post-avatar"></div>
                            <div class="post-user">
                                <span class="user-name"><?= esc($post['author']) ?></span>
                                <span class="post-time"><?= esc($post['time']) ?> ago</span>
                            </div>
                        </div>
                        <div class="post-content">
                            <?= esc($post['content']) ?>
                        </div>
                        <div class="post-footer">
                            <span class="like" onclick="handleLike(<?= $post['id'] ?>)"><i class="fas fa-thumbs-up"></i> Like</span>
                            <span class="comment" onclick="toggleCommentSection(<?= $post['id'] ?>)"><i class="fas fa-comment"></i> Comment</span>
                            <span class="share"><i class="fas fa-share"></i> Share</span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No posts available.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
