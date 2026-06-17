<?php

use Core\Database;

adminOnly();

$config = require base_path('config.php');

$db = new Database($config);
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
            'id' => $_GET['id']
        ]
    )
    ->findOrFail();

$css = '<link rel="stylesheet" href="/css/users/edit.css">';
view('users/edit.view.php', [

    'pageTitle' => 'Edit User',

    'this_user' => $user,
    'rooms' => $rooms,
    'css' => $css

]);