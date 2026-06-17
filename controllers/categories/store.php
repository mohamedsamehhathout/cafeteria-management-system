<?php

use Core\Database;
use Core\Validator; 

$config = require base_path('config.php');
$db = new Database($config);

$errors = [];


if (! Validator::string($_POST['name'], 1, 50)) {
    $errors['name'] = "A category name between 1 and 50 characters is required.";
}

if (! Validator::string($_POST['description'], 1, 255)) {
    $errors['description'] = "A description is required and cannot exceed 255 characters.";
}

if (empty($errors)) {
    
    $db->query("INSERT INTO categories (name, description) VALUES (:name, :description)", [
        'name' => $_POST['name'],
        'description' => $_POST['description']
    ]);

    header('location: /categories');
    exit();
}

$css = '<link rel="stylesheet" href="/css/categories/create.css">';
view('categories/create.view.php', [
    'css' => $css,
    'errors' => $errors
]);