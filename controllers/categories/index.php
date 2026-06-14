<?php

adminOnly();

$dbService = getDbService();
$categories = $dbService->query("SELECT * FROM categories ORDER BY name ASC");

view('categories/index.view.php', [
    'categories' => $categories
]);

