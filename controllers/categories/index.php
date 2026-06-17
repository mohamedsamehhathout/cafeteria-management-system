<?php

adminOnly();

use Core\Database;

$config = require base_path('config.php');

$db = new Database($config);

$categories = $db
    ->query("
        SELECT
            categories.*,
            COUNT(products.id) AS product_count
        FROM categories
        LEFT JOIN products
            ON products.category_id = categories.id
        GROUP BY categories.id
        ORDER BY categories.name
    ")
    ->get();

$css = '<link rel="stylesheet" href="/css/categories/index.css">';
view('categories/index.view.php', [
    'categories' => $categories,
    'css' => $css
]);