<?php

use Core\Database;
use Core\Validator; 

$config = require base_path('config.php');
$db = new Database($config);

$errors = [];

$product = $db->query("SELECT * FROM products WHERE id = :id", [
    'id' => $_POST['id'] ?? 0
])->findOrFail();

if (! Validator::string($_POST['name'], 1, 100)) {
    $errors['name'] = "A product name between 1 and 100 characters is required.";
}

if (! isset($_POST['price']) || ! is_numeric($_POST['price']) || $_POST['price'] <= 0) {
    $errors['price'] = "A valid price greater than 0 is required.";
}

$categoryExists = $db->query("SELECT id FROM categories WHERE id = :id", [
    'id' => $_POST['category_id'] ?? 0
])->find();

if (! $categoryExists) {
    $errors['category_id'] = "Please select a valid category.";
}

$imagePath = $product['image']; 

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName = $_FILES['image']['name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
    $maxFileSize = 2 * 1024 * 1024; 

    if (! in_array($fileExtension, $allowedExtensions)) {
        $errors['image'] = "Invalid file type. Only JPG, JPEG, PNG, and WEBP are allowed.";
    } elseif ($_FILES['image']['size'] > $maxFileSize) {
        $errors['image'] = "The image size cannot exceed 2MB.";
    } else {
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        
        $uploadFileDir = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
        $destPath = $uploadFileDir . $newFileName;

        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $imagePath = '/uploads/' . $newFileName; 
            
            $oldFilePath = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'public' . str_replace('/', DIRECTORY_SEPARATOR, $product['image']);
            if ($product['image'] !== '/images/default-product.png' && file_exists($oldFilePath)) {
                @unlink($oldFilePath);
            }
        } else {
            $errors['image'] = "There was an error moving the uploaded file.";
        }
    }
}

if (empty($errors)) {
    $db->query(
        "UPDATE products 
         SET name = :name, price = :price, category_id = :category_id, image = :image 
         WHERE id = :id", 
        [
            'id'          => $_POST['id'],
            'name'        => $_POST['name'],
            'price'       => $_POST['price'],
            'category_id' => $_POST['category_id'],
            'image'       => $imagePath
        ]
    );

    header('location: /products');
    exit();
}

$categories = $db->query("SELECT id, name FROM categories")->get();

view("products/edit.view.php", [
    'errors'     => $errors,
    'product'    => $product,
    'categories' => $categories 
]);