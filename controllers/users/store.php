<?php

use Core\Database;

adminOnly();

$config = require base_path('config.php');

$db = new Database($config);

$db->query(
    "
    INSERT INTO users
    (
        name,
        email,
        password,
        role,
        room_id,
        extension
    )
    VALUES
    (
        :name,
        :email,
        :password,
        :role,
        :room_id,
        :extension
    )
    ",
    [

        'name' => $_POST['name'],

        'email' => $_POST['email'],

        'password' => password_hash(
            $_POST['password'],
            PASSWORD_DEFAULT
        ),

        'role' => $_POST['role'],

        'room_id' => $_POST['room_id'],

        'extension' => $_POST['extension']
    ]
);

redirect('/users');