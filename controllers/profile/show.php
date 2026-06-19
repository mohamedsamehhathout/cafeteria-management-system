<?php

use Core\Auth;
use Core\Database;

auth();

$config = require base_path('config.php');

$db = new Database($config);

$user = $db
    ->query(
        "SELECT users.*, rooms.room_number
         FROM users
         LEFT JOIN rooms
         ON users.room_id = rooms.id
         WHERE users.id = :id",
        [
            'id' => Auth::user()['id']
        ]
    )
    ->find();


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


$css = '<link rel="stylesheet" href="/css/profile/index.css">';
view('profile/show.view.php', [
    'pageTitle' => 'Profile',
    'profile' => $user,
    'css' => $css,
    'image' => $imagePath
]);