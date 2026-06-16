<?php

use Core\Database;
use Core\Validator;
adminOnly();

$errors = [];


if (! Validator::email($_POST['email'])) {

    $errors['email'] = 'Please enter a valid email.';
}

if (! Validator::password($_POST['password'], 8)) {

    $errors['password'] =
        'Password must be at least 8 characters.';
}


$config = require base_path('config.php');
$db = new Database($config);


$emailExists = $db
    ->query(
        "SELECT id
         FROM users
         WHERE email = :email",
        [
            'email' => $_POST['email']
        ]
    )
    ->find();

if ($emailExists) {

    $errors['email'] =
        'Email already exists.';
}




if ($_POST['room_id'] === 'new' && empty(trim($_POST['new_room']))) {

    redirect('/users/create');
}


$roomId = $_POST['room_id'];

if ($_POST['room_id'] === 'new') {

    $roomNumber = trim($_POST['new_room']);

    $existingRoom = $db->query(
            "
            SELECT id
            FROM rooms
            WHERE room_number = :room_number
            ",
            [
                'room_number' => $roomNumber
            ]
        )->find();

    if ($existingRoom) {

        $roomId = $existingRoom['id'];

    } else {

        $db->query(
            "
            INSERT INTO rooms (room_number)
            VALUES (:room_number)
            ",
            [
                'room_number' => $roomNumber
            ]
        );

        $roomId = $db->connection->lastInsertId();
    }
}
$rooms = $db
    ->query("
        SELECT *
        FROM rooms
        ORDER BY room_number
    ")
    ->get();
if (empty($errors)) {

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

        'room_id' => $roomId,

        'extension' => $_POST['extension']
    ]
);

    redirect('/users');
}
view('users/create.view.php', [

        'errors' => $errors,
        'rooms' => $rooms

    ]);
