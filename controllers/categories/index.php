<?php

use Core\Database;

// 1. Load project's configuration file
$config = require base_path('config.php');

// 2. Create a new Database instance and pass the config array directly
$db = new Database($config);

// 3. Fetch the data using get() method
$categories = $db->query("SELECT * FROM categories")->get();

// 4. Pass the data to the view
view('categories/index.view.php', [
    'categories' => $categories
]);