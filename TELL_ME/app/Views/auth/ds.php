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
    .no-posts-message {
    display: inline-block; /* Agar kotak sesuai dengan ukuran teks */
    padding: 10px 20px;    /* Ruang di dalam kotak */
    background-color: #f0f0f0; /* Warna latar kotak */
    border: 1px solid #ccc;    /* Border tipis */
    border-radius: 5px;        /* Sudut membulat */
    color: #333;               /* Warna teks */
    font-family: Arial, sans-serif; /* Gaya font */
    font-size: 16px;           /* Ukuran font */
    text-align: center;        /* Teks rata tengah */
    margin: 20px auto;         /* Jarak dari elemen lain */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Efek bayangan */
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
            <form id="post-form" method="POST" action="<?= base_url('post/create') ?>">
                <input type="text" id="post-text" name="post_text" placeholder="What's on your mind?" required>
                <button type="submit">+</button>
            </form>
        </div>
        <div class="posts">
        <?php if (empty($posts)): ?>
            <div class="no-posts-message">
            Gak ada post :C
        </div>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <div class="post" data-id="<?= $post['post_id'] ?>">
                <div class="post-header">
                    <div class="post-avatar"></div>
                    <div class="post-user">
                        <span class="user-name"><?= $post['username'] ?></span>
                        <span class="post-time"><?= $post['created_at'] ?></span>
                    </div>
                </div>
                <div class="post-content">
                    <?= $post['content'] ?>
                </div>
                <div class="post-footer">
                                <span class="like" onclick="window.location.href='<?= base_url('post/like/'.$post['post_id']) ?>'">
                                <i class="fas fa-thumbs-up"></i> 
                                Like (<?= $post['like_count'] ?>)
                                </span>
                    <span class="comment" onclick="toggleCommentSection(<?= $post['post_id'] ?>)"><i class="fas fa-comment"></i> Comment</span>
                    <span class="share">
                        <i class="fas fa-share"></i> 
                        <a href="#" onclick="copyToClipboard('<?= base_url('post/share/'.$post['post_id']) ?>')" style="text-decoration: none; color: inherit;">Share</a>

                    </span>

                </div>
                <div class="comments-section" id="comments-<?= $post['post_id'] ?>" style="display: none;">
                    <div class="comments-list" id="comments-list-<?= $post['post_id'] ?>"></div>
                    <input type="text" class="comment-input" id="comment-input-<?= $post['post_id'] ?>" placeholder="Add a comment..." onkeypress="handleComment(event, <?= $post['post_id'] ?>)">
                </div>
            </div>
            <hr class="comment-separator">
                            <!-- Comment Section -->
                            <div class="comments-section" id="comments-<?= $post['post_id'] ?>" style="display: none;">
                    <!-- Display Comments -->
                    <div class="comments-list" id="comments-list-<?= $post['post_id'] ?>">
    <?php if (!empty($post['comments'])): ?>
        <?php foreach ($post['comments'] as $comment): ?>
            <div class="comment">
                <strong><?= $comment['username'] ?>:</strong>
                <p><?= $comment['content'] ?></p>
                <small><?= $comment['created_at'] ?></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No comments yet.</p>
    <?php endif; ?>
</div>


                    <!-- Comment Input Form -->
                    <input type="text" class="comment-input" id="comment-input-<?= $post['post_id'] ?>" placeholder="Add a comment..." onkeypress="handleComment(event, <?= $post['post_id'] ?>)">
                </div>
        <?php endforeach; ?>
    <?php endif; ?>
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

    <script>
function copyToClipboard(link) {
    // Create a temporary input element
    const tempInput = document.createElement("input");
    document.body.appendChild(tempInput);
    tempInput.value = link; // Set value to the link to share
    tempInput.select(); // Select the text in the input
    document.execCommand('copy'); // Copy the selected text to clipboard
    document.body.removeChild(tempInput); // Clean up the temporary input

    // Optionally, show a confirmation message
    alert("Link copied to clipboard!");
}

function toggleCommentSection(postId) {
    var commentSection = document.getElementById('comments-' + postId);
    // Toggle visibility of the comment section
    if (commentSection.style.display === "none") {
        commentSection.style.display = "block";
    } else {
        commentSection.style.display = "none";
    }
}

function handleComment(event, postId) {
    if (event.key === 'Enter') {
        var commentContent = document.getElementById('comment-input-' + postId).value;

        if (commentContent.trim() !== '') {
            // Send the comment to the server via AJAX
            fetch('<?= base_url('post/comment') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?= csrf_hash() ?>', // CSRF protection
                },
                body: JSON.stringify({
                    post_id: postId,
                    comment_content: commentContent
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // If comment is saved successfully, add it to the comments section
                    var commentsList = document.getElementById('comments-list-' + postId);
                    var newComment = document.createElement('div');
                    newComment.classList.add('comment');
                    newComment.innerHTML = `<strong><?= session()->get('username') ?>:</strong> <p>${commentContent}</p><small>Just now</small>`;
                    commentsList.appendChild(newComment);
                    
                    // Clear the input and hide the comment section
                    document.getElementById('comment-input-' + postId).value = '';
                    toggleCommentSection(postId); // Hide comment section
                } else {
                    alert('Failed to post comment!');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }
}
    </script>
</body>
</html>
