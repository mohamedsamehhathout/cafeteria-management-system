<?php

use Core\Database;
use Core\Validator;

$config = require base_path('config.php');
$db = new Database($config);

$errors = [];

// 1. Validate the inputs
if (! Validator::string($_POST['name'], 1, 50)) {
    $errors['name'] = "A category name between 1 and 50 characters is required.";
}

if (! Validator::string($_POST['description'], 1, 255)) {
    $errors['description'] = "A description is required and cannot exceed 255 characters.";
}

// 2. If there are errors, send them back to the edit form
if (! empty($errors)) {
    // We have to fetch the category again so the form knows which ID it's editing
    $category = $db->query("SELECT * FROM categories WHERE id = :id", [
        'id' => $_POST['id']
    ])->findOrFail();

    return view("categories/edit.view.php", [
        'category' => $category,
        'errors' => $errors
    ]);
}

// 3. If no errors, update the database
$db->query("UPDATE categories SET name = :name, description = :description WHERE id = :id", [
    'name' => $_POST['name'],
    'description' => $_POST['description'],
    'id' => $_POST['id']
]);

// 4. Redirect back to the dashboard
header('location: /categories');
exit();