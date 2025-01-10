<?php
session_start();
require 'includes/db.php';
require 'includes/functions.php';

if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id'])) {
    addToCart($_GET['id']);
    header('Location: cart.php');
    exit;
}

$cartItems = getCartItems($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Tell Me</title>
</head>
<body>
    <h1>Your Cart</h1>
    <a href="index.php">Back to Products</a>
    <hr>
    <ul>
        <?php foreach ($cartItems as $item): ?>
            <li>
                <?= htmlspecialchars($item['name']) ?> - $<?= number_format($item['price'], 2) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
