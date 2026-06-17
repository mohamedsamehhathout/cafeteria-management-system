<?php

use Core\Database;
use Core\Validator;

adminOnly();

$config = require base_path('config.php');

$db = new Database($config);

$errors = [];



if (! Validator::string($_POST['name'], 1, 255)) {

    $errors['name'] = 'Name is required.';
}

if (! Validator::email($_POST['email'])) {

    $errors['email'] = 'Please enter a valid email.';
}

$emailExists = $db
    ->query(
        "
        SELECT id
        FROM users
        WHERE email = :email
        AND id != :id
        ",
        [
            'email' => $_POST['email'],
            'id' => $_POST['id']
        ]
    )
    ->find();

if ($emailExists) {

    $errors['email'] = 'Email already exists.';
}

if (! empty($_POST['password'])) {

    if (strlen($_POST['password']) < 8) {

        $errors['password'] =
            'Password must be at least 8 characters.';
    }


}



if ($_POST['room_id'] === 'new' && empty(trim($_POST['new_room']))) {

    $errors['room'] = 'Please enter a room number.';
}

if (! empty($errors)) {
    

    $rooms = $db
        ->query("
            SELECT *
            FROM rooms
            ORDER BY room_number
        ")
        ->get();

    $user = $db
        ->query(
            "
            SELECT
            users.*,
            rooms.room_number
        FROM users
        LEFT JOIN rooms
            ON rooms.id = users.room_id
        WHERE users.id = :id
            
            ",
            [
                'id' => $_POST['id']
            ]
        )
        ->findOrFail();
    view('users/edit.view.php', [
        'this_user' => $user,
        'rooms' => $rooms,
        'errors' => $errors

    ]);
    exit();
}

$roomId = $_POST['room_id'];

if ($_POST['room_id'] === 'new') {

    $roomNumber = trim($_POST['new_room']);
    $roomDescription = trim($_POST['room_description']);

    $existingRoom = $db
        ->query(
            "
            SELECT id
            FROM rooms
            WHERE room_number = :room_number
            ",
            [
                'room_number' => $roomNumber
            ]
        )
        ->find();

    if ($existingRoom) {

        $roomId = $existingRoom['id'];

    } else {

        $db->query(
            "
            INSERT INTO rooms (room_number, description)
            VALUES (:room_number, :description)
            ",
            [
                'room_number' => $roomNumber,
                'description' => $roomDescription
            ]
        );

        $roomId = $db->connection->lastInsertId();
    }
}



if (! empty($_POST['password'])) {

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

            'room_id' => $roomId,

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

            'room_id' => $roomId,

            'extension' => $_POST['extension']
        ]
    );

}

redirect('/users');