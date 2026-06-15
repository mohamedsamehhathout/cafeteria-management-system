<?php

use Core\Database;

adminOnly();

$config = require base_path('config.php');

$db = new Database($config);

$user = $db
    ->query(
        "SELECT * FROM users WHERE id = :id",
        [
            'id' => $_GET['id']
        ]
    )
    ->findOrFail();

view('users/edit.view.php', [

    'pageTitle' => 'Edit User',

    'this_user' => $user

]);