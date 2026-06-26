<?php

use Core\Database;
use Core\Session;

use Core\Auth;

userOnly();

$config = require base_path('config.php');

$db = new Database($config);

$currentUser = Session::get('user');

$orders = $db
    ->query("
            SELECT
            orders.*,
            COUNT(order_items.id) AS items_count
        FROM orders
        LEFT JOIN order_items
            ON order_items.order_id = orders.id
        WHERE orders.user_id = :user_id
        GROUP BY orders.id
        ORDER BY orders.created_at DESC
        
    ", [

        'user_id' => $currentUser['id']

    ])
    ->get();

$css = '<link rel="stylesheet" href="/css/orders/user-orders.css">';

view('orders/user/index.view.php', [

    'pageTitle' => 'My Orders',

    'orders' => $orders,

    'css' => $css

]);