<?php

adminOnly();

$dbService = getDbService();

$categories = $dbService->query("SELECT * FROM categories ORDER BY name ASC");

$products = $dbService->query(
    "SELECT products.*, categories.name AS category_name
     FROM products
     JOIN categories ON categories.id = products.category_id
     WHERE products.is_available = 1
     ORDER BY categories.name ASC, products.name ASC"
);

$users = $dbService->query(
    "SELECT users.id, users.name, rooms.room_number
     FROM users
     LEFT JOIN rooms ON rooms.id = users.room_id
     WHERE users.role = 'user'
     ORDER BY users.name ASC"
);

view('orders/manual.view.php', [
    'pageTitle' => 'Manual Order',
    'categories' => $categories,
    'products' => $products,
    'users' => $users
]);

