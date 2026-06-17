<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config);

$categories = $db->query("SELECT id, name FROM categories")->get();

view("products/create.view.php", [
    'categories' => $categories,
    'errors'     => []
]);