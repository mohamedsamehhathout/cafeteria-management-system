<?php
adminOnly();


use Core\Database;

$config = require base_path('config.php');

$db = new Database($config);

$products = $db->query("
    SELECT products.*, categories.name AS category_name 
    FROM products
    LEFT JOIN categories ON products.category_id = categories.id
")->get();

$css = '<link rel="stylesheet" href="/css/products/index.css">';
view('products/index.view.php', [
    'products' => $products,
    'css' => $css
]);