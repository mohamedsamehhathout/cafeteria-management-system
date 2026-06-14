<?php

adminOnly();

$dbService = getDbService();
$users = $dbService->query("SELECT * FROM users ORDER BY name ASC");

view('users/index.view.php', [
    'users' => $users
]);

