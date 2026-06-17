<?php

use Core\Database;

adminOnly();

$config = require base_path('config.php');

$db = new Database($config);

$user = $db
    ->query("
        SELECT
            users.*,
            rooms.room_number
        FROM users
        LEFT JOIN rooms
            ON rooms.id = users.room_id
        WHERE users.id = :id
    ", [
        'id' => $_GET['id']
    ])
    ->findOrFail();
$css = '<link rel="stylesheet" href="/css/users/show.css">';
view('users/show.php', [

    'pageTitle' => 'User Details',

    'this_user' => $user,
    'css' => $css

]);