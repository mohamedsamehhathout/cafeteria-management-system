<?php

use Core\Database;
use Core\Session;

$config = require base_path('config.php');

$db = new Database($config);

$email = $_POST['email'];
$password = $_POST['password'];

$user = $db
    ->query(
        "SELECT * FROM users WHERE email = :email",
        [
            'email' => $email
        ]
    )
    ->find();


$css = '<link rel="stylesheet" href="/css/auth/login.css">';


if (! $user || ! password_verify($_POST['password'], $user['password'])) {

    Session::put('errors', [
        'auth' => 'Invalid email or password.'
    ]);

    redirect('/login');
}

Session::put('user', [

    'id' => $user['id'],

    'name' => $user['name'],

    'email' => $user['email'],

    'role' => $user['role']

]);

if ($user['role'] === 'admin') {

    redirect('/dashboard');
}

redirect('/home');