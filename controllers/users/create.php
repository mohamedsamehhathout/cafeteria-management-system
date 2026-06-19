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
$css = '<link rel="stylesheet" href="/css/users/create.css">';
view('users/create.view.php', [

    'pageTitle' => 'Add User',

    'rooms' => $rooms,
    'css' => $css

]);