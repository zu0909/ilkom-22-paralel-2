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

?>

<!-- HTML form for search -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>
    <h1>Search Social Media</h1>
    <form action="/search" method="GET">
        <input type="text" name="q" placeholder="Search for users or posts" required>
        <button type="submit">Search</button>
    </form>
</body>
</html>
