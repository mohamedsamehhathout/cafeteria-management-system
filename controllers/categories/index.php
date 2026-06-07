<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config);

$categories = $db->query("
    SELECT categories.*, COUNT(products.id) AS product_count 
    FROM categories 
    LEFT JOIN products ON categories.id = products.category_id 
    GROUP BY categories.id
")->get();

view('categories/index.view.php', [
    'categories' => $categories
]);