<?php

use Core\Auth;

userOnly();

$dbService = getDbService();
$userId = Auth::user()['id'];

$categories = $dbService->query("SELECT * FROM categories ORDER BY name ASC");

$products = $dbService->query(
    "SELECT products.*, categories.name AS category_name
     FROM products
     JOIN categories ON categories.id = products.category_id
     WHERE products.is_available = 1
     ORDER BY categories.name ASC, products.name ASC"
);

$latestOrder = $dbService->query(
    "SELECT id, status, total_amount, created_at FROM orders
     WHERE user_id = :user_id
     ORDER BY created_at DESC
     LIMIT 1",
    ['user_id' => $userId]
);

$latestOrder = $latestOrder[0] ?? null;

view('orders/home.view.php', [
    'pageTitle' => 'Order Now',
    'categories' => $categories,
    'products' => $products,
    'latestOrder' => $latestOrder
]);

