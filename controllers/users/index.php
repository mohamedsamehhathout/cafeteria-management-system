<?php

use Core\Database;

adminOnly();

$config = require base_path('config.php');

$db = new Database($config);
$allowedColumns = [
    'name' => 'users.name',
    'email' => 'users.email',
    'role' => 'users.role',
    'extension' => 'users.extension',
    'created_at' => 'users.created_at',
    'room_number' => 'rooms.room_number'
];

$sort = $_GET['sort'] ?? 'name';

$orderBy = $allowedColumns[$sort] ?? 'users.name';

// if (! in_array($sort, $allowedColumns)) {
//     $sort = 'name';
// }
$direction = $_GET['direction'] ?? 'asc';

if (! in_array($direction, ['asc', 'desc'])) {
    $direction = 'asc';
}
$users = $db
    ->query("
        SELECT
            users.*,
            rooms.room_number
        FROM users
        LEFT JOIN rooms
            ON rooms.id = users.room_id
        ORDER BY {$orderBy} {$direction}
    ")
    ->get();


view('users/index.view.php', [

    'pageTitle' => 'Users Management',

    'users' => $users,
    'direction' => $direction,
    'sort' => $sort

]);