<?php

use Core\Database;

adminOnly();

$config = require base_path('config.php');

$db = new Database($config);

$processingOrders = $db
    ->query("
        SELECT
            orders.*,
            users.name AS user_name,
            rooms.room_number
        FROM orders
        JOIN users
            ON users.id = orders.user_id
        LEFT JOIN rooms
            ON rooms.id = orders.room_id
        WHERE orders.status = 'processing'
        ORDER BY orders.created_at DESC
    ")
    ->get();

$deliveryOrders = $db
    ->query("
        SELECT
            orders.*,
            users.name AS user_name,
            rooms.room_number
        FROM orders
        JOIN users
            ON users.id = orders.user_id
        LEFT JOIN rooms
            ON rooms.id = orders.room_id
        WHERE orders.status = 'out_for_delivery'
        ORDER BY orders.created_at DESC
    ")
    ->get();

$doneOrders = $db
    ->query("
        SELECT
            orders.*,
            users.name AS user_name,
            rooms.room_number
        FROM orders
        JOIN users
            ON users.id = orders.user_id
        LEFT JOIN rooms
            ON rooms.id = orders.room_id
        WHERE orders.status = 'done'
        ORDER BY orders.created_at DESC
        LIMIT 10
    ")
    ->get();

foreach ($processingOrders as &$order) {

    $order['items'] = $db
        ->query("
            SELECT
                products.name,
                order_items.quantity
            FROM order_items
            JOIN products
                ON products.id = order_items.product_id
            WHERE order_items.order_id = :order_id
        ", [
            'order_id' => $order['id']
        ])
        ->get();
}

foreach ($deliveryOrders as &$order) {

    $order['items'] = $db
        ->query("
            SELECT
                products.name,
                order_items.quantity
            FROM order_items
            JOIN products
                ON products.id = order_items.product_id
            WHERE order_items.order_id = :order_id
        ", [
            'order_id' => $order['id']
        ])
        ->get();
}

foreach ($doneOrders as &$order) {

    $order['items'] = $db
        ->query("
            SELECT
                products.name,
                order_items.quantity
            FROM order_items
            JOIN products
                ON products.id = order_items.product_id
            WHERE order_items.order_id = :order_id
        ", [
            'order_id' => $order['id']
        ])
        ->get();
}

$css = '<link rel="stylesheet" href="/css/orders/admin-orders.css">';
view('orders/admin-orders.view.php', [

    'pageTitle' => 'Orders',
    'processingOrders' => $processingOrders,
    'deliveryOrders' => $deliveryOrders,
    'doneOrders' => $doneOrders,
    'css' => $css

]);