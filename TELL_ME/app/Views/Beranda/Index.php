<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media UI</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/styleBeranda.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo"></div>
            <div class="sidebar-item profile-icon">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </div>
            <div class="sidebar-item notifications-icon">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </div>
            <div class="sidebar-item messages-icon">
                <i class="fas fa-envelope"></i>
                <span>Messages</span>
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
