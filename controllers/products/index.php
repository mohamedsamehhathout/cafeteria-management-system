<?php

adminOnly();

$dbService = getDbService();
$products = $dbService->query(
    "SELECT products.*, categories.name AS category_name
     FROM products
     JOIN categories ON categories.id = products.category_id
     ORDER BY products.name ASC"
);

view('products/index.view.php', [
    'products' => $products
]);
