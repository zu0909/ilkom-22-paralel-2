<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media UI</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/styleBeranda.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    .main-content {
        flex: 1;
        padding: 20px;
        background-color: #3a3a3a;
        position: relative;
        /* Menambahkan gambar background kiri, kanan, dan atas dengan ukuran dan posisi */
        background-image: url('<?= base_url('images/atas.png') ?>'), url('<?= base_url('images/kiri.png') ?>'), url('<?= base_url('images/kanan.png') ?>');
        background-position: top center, left center, right center; /* Menempatkan gambar di kiri, kanan, dan atas */
        background-repeat: no-repeat; /* Gambar tidak diulang */
        background-size: 1000px 160px, 150px 690px, 150px 690px; /* Mengatur ukuran gambar: kiri & kanan 150x690px, atas full-width */
    }
    .profile-button, .notifications-button {
        background: none;
        border: none;
        color: inherit;
        cursor: pointer;
        font: inherit;
        outline: inherit;
        padding: 0;
        margin: 0;
    }
    </style>
</head>
<body> 
    <div class="container">  
        <aside class="sidebar">
            <div class="logo">
                <!-- Menampilkan logo dari folder public/images/logo -->
                <img src="<?= base_url('images/logoo.png') ?>" alt="Logo" />
            </div>
            <div class="sidebar-item profile-icon">
                <i class="fas fa-user"></i>
                <!-- Menampilkan username yang login dengan gaya tombol -->
                <button class="profile-button" onclick="window.location.href='<?= base_url('profile/index') ?>'">
                    <span><?= session()->get('username') ?></span>
                </button>
            </div>
            <div class="sidebar-item notifications-icon">
                <i class="fas fa-bell"></i>
                <!-- Menambahkan tombol notifikasi -->
                <button class="notifications-button" onclick="window.location.href='<?= base_url('notif/index') ?>'">
                    <span>Notifications</span>
                </button>
            </div>
            <div class="sidebar-item logout-icon">
                <form action="<?= base_url('auth/logout') ?>" method="post" style="display:inline;">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </aside>
        <main class="main-content">
            <div class="stories">
                <div class="story add-story">Add Story</div>
                <div class="story"></div>
                <div class="story"></div>
                <div class="story"></div>
                <div class="story"></div>
            </div>
            <div class="post-input">
                <form id="post-form">
                    <input type="text" id="post-text" placeholder="What's on your mind?">
                    <button type="submit">+</button>
                </form>
            </div>
            <div class="posts">
                <div class="post" data-id="1">
                    <div class="post-header">
                        <div class="post-avatar"></div>
                        <div class="post-user">
                            <span class="user-name">John Doe</span>
                            <span class="post-time">2h ago</span>
                        </div>
                    </div>
                    <div class="post-content">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </div>
                    <div class="post-footer">
                        <span class="like" onclick="handleLike(1)"><i class="fas fa-thumbs-up"></i> Like</span>
                        <span class="comment" onclick="toggleCommentSection(1)"><i class="fas fa-comment"></i> Comment</span>
                        <span class="share"><i class="fas fa-share"></i> Share</span>
                    </div>
                    <div class="comments-section" id="comments-1" style="display: none;">
                        <div class="comments-list" id="comments-list-1"></div>
                        <input type="text" class="comment-input" id="comment-input-1" placeholder="Add a comment..." onkeypress="handleComment(event, 1)">
                    </div>
                </div>
                <!-- Tambahkan lebih banyak post di sini jika perlu -->
            </div>
        </main>
        <aside class="right-sidebar">
            <div class="messages-section">
                <div class="search-messages">
                    <input type="text" placeholder="Search">
                </div>
                <div class="message-list">
                    <div class="message">
                        <div class="message-header">
                            <span>John Doe</span><span class="message-time">16:45</span>
                        </div>
                        <p>How are you doing?</p>
                    </div>
                </div>
            </div>
        </aside>
    </div>
    <script src="script.js"></script>
</body>
</html>
