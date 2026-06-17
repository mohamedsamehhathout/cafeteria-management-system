<?php

use Core\Auth;
use Core\Database;

adminOnly();

$config = require base_path('config.php');

$db = new Database($config);

$productsCount = $db
    ->query("SELECT COUNT(*) as count FROM products")
    ->find()['count'];

$categoriesCount = $db
    ->query("SELECT COUNT(*) as count FROM categories")
    ->find()['count'];

$usersCount = $db
    ->query("SELECT COUNT(*) as count FROM users")
    ->find()['count'];

$ordersCount = $db
    ->query("SELECT COUNT(*) as count FROM orders")
    ->find()['count'];

$processingOrders = $db
    ->query("
        SELECT COUNT(*) as count
        FROM orders
        WHERE status = 'processing'
    ")
    ->find()['count'];

$recentOrders = $db
    ->query("
        SELECT
            orders.id,
            users.name,
            rooms.room_number,
            orders.total_amount,
            orders.status
        FROM orders
        JOIN users
            ON users.id = orders.user_id
        LEFT JOIN rooms
            ON rooms.id = orders.room_id
        ORDER BY orders.created_at DESC
        LIMIT 5
    ")
    ->get();
$css = '<link rel="stylesheet" href="/css/admin/dashboard.css">';
view('admin/dashboard.view.php', [

    'pageTitle' => 'Dashboard',

    'productsCount' => $productsCount,
    'categoriesCount' => $categoriesCount,
    'usersCount' => $usersCount,
    'ordersCount' => $ordersCount,
    'processingOrders' => $processingOrders,
    'recentOrders' => $recentOrders,
    'css' => $css

]);