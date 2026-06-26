<?php

use Core\Database;
use Core\Auth;
use Core\Session;


$config = require base_path('config.php');

$db = new Database($config);

$order = $db
    ->query("
        SELECT *
        FROM orders
        WHERE id = :id
    ", [
        'id' => $_GET['id']
    ])
    ->findOrFail();

if ($order['status'] !== 'processing') {

    abort(403);
}
if (
    ! Auth::isAdmin()
    &&
    $order['user_id'] != Session::get('user')['id']
) {

    abort(401);
}
$orderItems = $db
    ->query("
        SELECT
            order_items.id,
            order_items.product_id,
            order_items.quantity,
            order_items.unit_price,
            order_items.subtotal,
            products.name
        FROM order_items
        JOIN products
            ON products.id = order_items.product_id
        WHERE order_items.order_id = :id
    ", [
        'id' => $order['id']
    ])
    ->get();

$products = $db
    ->query("
        SELECT
            id,
            name,
            price
        FROM products
        WHERE is_available = 1
        ORDER BY name
    ")
    ->get();

$css = '<link rel="stylesheet" href="/css/orders/edit.css">';

view('orders/user/edit.view.php', [

    'pageTitle' => 'Edit Order',

    'order' => $order,

    'orderItems' => $orderItems,

    'products' => $products,
    'css' => $css

]);