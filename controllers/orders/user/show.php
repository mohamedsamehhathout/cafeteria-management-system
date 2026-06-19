<?php

use Core\Database;
use Core\Auth;
use Core\Session;

$config = require base_path('config.php');

$db = new Database($config);

$order = $db
    ->query("
        SELECT
            orders.*,
            users.name AS user_name,
            users.email,
            rooms.room_number
        FROM orders
        JOIN users
            ON users.id = orders.user_id
        LEFT JOIN rooms
            ON rooms.id = orders.room_id
        WHERE orders.id = :id
    ", [
        'id' => $_GET['id']
    ])
    ->findOrFail();
if (
    ! Auth::isAdmin()
    &&
    $order['user_id'] != Session::get('user')['id']
) {

    abort(403);
}

$orderItems = $db
    ->query("
        SELECT
            products.name,
            order_items.quantity,
            order_items.unit_price,
            order_items.subtotal
        FROM order_items
        JOIN products
            ON products.id = order_items.product_id
        WHERE order_items.order_id = :id
    ", [
        'id' => $_GET['id']
    ])
    ->get();

$css = '<link rel="stylesheet" href="/css/orders/show.css">';

view('orders/user/show.view.php', [

    'pageTitle' => 'Order Details',

    'order' => $order,

    'items' => $orderItems,
    'css' => $css


]);