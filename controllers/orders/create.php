<?php

use Core\Database;

adminOnly();

$config = require base_path('config.php');

$db = new Database($config);

$products = $db
    ->query("
        SELECT
            products.*,
            categories.name AS category_name
        FROM products
        LEFT JOIN categories
            ON categories.id = products.category_id
        WHERE products.is_available = 1
        ORDER BY products.name
    ")
    ->get();

$users = $db
    ->query("
        SELECT
            users.*,
            rooms.room_number
        FROM users
        LEFT JOIN rooms
            ON rooms.id = users.room_id
        ORDER BY users.name
    ")
    ->get();

$css = '<link rel="stylesheet" href="/css/orders/create.css">';

view('orders/create.view.php', [

    'pageTitle' => 'Create Order',

    'products' => $products,

    'users' => $users,

    'css' => $css

]);