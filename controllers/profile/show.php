<?php

use Core\Auth;
use Core\Database;

if (! Auth::check()) {
    redirect('/login');
}

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

view('profile/show.view.php', [
    'pageTitle' => 'Profile',
    'user' => $user
]);