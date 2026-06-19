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
        "
        SELECT id
        FROM users
        WHERE email = :email
        ",
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
    $roomDescription = trim($_POST['room_description']);

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
$rooms = $db
    ->query("
        SELECT *
        FROM rooms
        ORDER BY room_number
    ")
    ->get();

$imagePath = '/images/default-user.png';

if (
    isset($_FILES['image']) &&
    $_FILES['image']['error'] === UPLOAD_ERR_OK
) {

    $extension = strtolower(
        pathinfo(
            $_FILES['image']['name'],
            PATHINFO_EXTENSION
        )
    );

    $fileName =
        md5(time() . $_FILES['image']['name'])
        . '.'
        . $extension;

    $uploadDir =
        base_path(
            'public/uploads/users/'
        );

    if (! is_dir($uploadDir)) {

        mkdir(
            $uploadDir,
            0755,
            true
        );
    }

    move_uploaded_file(

        $_FILES['image']['tmp_name'],

        $uploadDir . $fileName

    );

    $imagePath =
        '/uploads/users/' . $fileName;
}

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
        extension,
        image
    )
    VALUES
    (
        :name,
        :email,
        :password,
        :role,
        :room_id,
        :extension,
        :image
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

        'extension' => $_POST['extension'],
        'image' => $imagePath
    ]
);

    redirect('/users');
}




view('users/create.view.php', [

        'errors' => $errors,
        'rooms' => $rooms

    ]);
