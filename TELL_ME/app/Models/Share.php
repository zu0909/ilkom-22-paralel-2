<?php

// Database connection
$host = 'localhost';
$db = 'social_media';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to search users and posts
function searchSocialMedia($keyword) {
    global $pdo;

    $keyword = "%" . $keyword . "%";

    // Search for users
    $userQuery = $pdo->prepare("SELECT id, username, email FROM users WHERE username LIKE :keyword OR email LIKE :keyword");
    $userQuery->execute(['keyword' => $keyword]);
    $users = $userQuery->fetchAll(PDO::FETCH_ASSOC);

    // Search for posts
    $postQuery = $pdo->prepare("SELECT posts.id, posts.content, posts.created_at, users.username FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.content LIKE :keyword");
    $postQuery->execute(['keyword' => $keyword]);
    $posts = $postQuery->fetchAll(PDO::FETCH_ASSOC);

    return [
        'users' => $users,
        'posts' => $posts
    ];
}

// Function to share a post
function sharePost($postId, $userId) {
    global $pdo;

    // Check if the post exists
    $postQuery = $pdo->prepare("SELECT * FROM posts WHERE id = :postId");
    $postQuery->execute(['postId' => $postId]);
    $post = $postQuery->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        return ['error' => 'Post not found'];
    }

    // Insert shared post into the database
    $shareQuery = $pdo->prepare("INSERT INTO posts (user_id, content, created_at) VALUES (:userId, :content, NOW())");
    $shareQuery->execute([
        'userId' => $userId,
        'content' => "Shared: " . $post['content']
    ]);

    return ['message' => 'Post shared successfully'];
}

// Simple router implementation
$requestUri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
$method = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/search' && $method === 'GET') {
    if (isset($_GET['q'])) {
        $keyword = $_GET['q'];
        $results = searchSocialMedia($keyword);

        header('Content-Type: application/json');
        echo json_encode($results);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Missing query parameter: q']);
    }
    exit;
}

if ($requestUri === '/share' && $method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['postId']) && isset($data['userId'])) {
        $result = sharePost($data['postId'], $data['userId']);

        header('Content-Type: application/json');
        echo json_encode($result);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Missing postId or userId']);
    }
    exit;
}

?>

<!-- HTML form for search and share -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media</title>
</head>
<body>
    <h1>Search Social Media</h1>
    <form action="/search" method="GET">
        <input type="text" name="q" placeholder="Search for users or posts" required>
        <button type="submit">Search</button>
    </form>

    <h1>Share a Post</h1>
    <form action="/share" method="POST" onsubmit="return sharePost(event)">
        <input type="number" name="postId" placeholder="Post ID to share" required>
        <input type="number" name="userId" placeholder="Your User ID" required>
        <button type="submit">Share</button>
    </form>

    <script>
        async function sharePost(event) {
            event.preventDefault();

            const form = event.target;
            const postId = form.postId.value;
            const userId = form.userId.value;

            const response = await fetch('/share', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ postId, userId })
            });

            const result = await response.json();
            alert(result.message || result.error);
        }
    </script>
</body>
</html>