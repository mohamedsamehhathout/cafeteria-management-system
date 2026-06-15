<?php

use Core\Database;

adminOnly();

$config = require base_path('config.php');

$db = new Database($config);

$db->query(
    "
    DELETE FROM users
    WHERE id = :id
    ",
    [
        'id' => $_POST['id']
    ]
);

redirect('/users');