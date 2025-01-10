<?php
session_start();
require 'includes/db.php';
require 'includes/functions.php';

$products = fetchProducts($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace - Tell Me</title>
</head>
<body>
    <h1>Welcome to Tell Me Marketplace</h1>
    <a href="add_product.php">Add Product</a> | <a href="cart.php">View Cart</a>
    <hr>
    <h2>Available Products</h2>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <strong><?= htmlspecialchars($product['name']) ?></strong> - $<?= number_format($product['price'], 2) ?>
                <a href="cart.php?action=add&id=<?= $product['id'] ?>">Add to Cart</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
