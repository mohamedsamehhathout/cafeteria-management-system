<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config);

$id = $_GET['id'] ?? 0;

$product = $db->query("SELECT * FROM products WHERE id = :id", [
    'id' => $id
])->findOrFail();

$categories = $db->query("SELECT id, name FROM categories")->get();

view("products/edit.view.php", [
    'product'    => $product,
    'categories' => $categories,
    'errors'     => []
]);