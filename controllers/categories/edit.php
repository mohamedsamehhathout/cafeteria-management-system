<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config);

$category = $db->query("SELECT * FROM categories WHERE id = :id", [
    'id' => $_GET['id']
])->findOrFail(); 

view('categories/edit.view.php', [
    'category' => $category,
    'errors' => []
]);