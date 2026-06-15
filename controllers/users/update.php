<?php

use Core\Database;

adminOnly();

$config = require base_path('config.php');

$db = new Database($config);

if (!empty($_POST['password'])) {

    $db->query(
        "
        UPDATE users
        SET
            name = :name,
            email = :email,
            password = :password,
            role = :role,
            room_id = :room_id,
            extension = :extension
        WHERE id = :id
        ",
        [

            'id' => $_POST['id'],

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

} else {

    $db->query(
        "
        UPDATE users
        SET
            name = :name,
            email = :email,
            role = :role,
            room_id = :room_id,
            extension = :extension
        WHERE id = :id
        ",
        [

            'id' => $_POST['id'],

            'name' => $_POST['name'],

            'email' => $_POST['email'],

            'role' => $_POST['role'],

            'room_id' => $_POST['room_id'],

            'extension' => $_POST['extension']
        ]
    );

}

redirect('/users');