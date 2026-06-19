<?php

use Core\Database;

use Core\Auth;

if (
    ! Auth::isAdmin()
    &&
    ! Auth::isUser()
) {

    abort(403);
}

$config = require base_path('config.php');

$db = new Database($config);

$products = $db
    ->query("
        SELECT
            products.*,
            categories.name category_name
        FROM products
        LEFT JOIN categories
            ON categories.id = products.category_id
        WHERE products.is_available = 1
        ORDER BY products.name
    ")
    ->get();

$css =
    '<link rel="stylesheet" href="/css/orders/create.css">';

view('orders/user/home.view.php', [

    'pageTitle' => 'Your Order',

    'products' => $products,

    'css' => $css

]);