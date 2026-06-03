<?php

use Core\Database;
use Core\Session;

$email = Session::get('reset_email');

if (! $email) {

    redirect('/forgot-password');
}

$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

if ($password !== $confirmPassword) {

    redirect('/reset-password');
}

$config = require base_path('config.php');

$db = new Database($config);

$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);

$db->query(
    "UPDATE users
     SET password = :password
     WHERE email = :email",
    [
        'password' => $hashedPassword,
        'email'    => $email
    ]
);

Session::forget('reset_email');

redirect('/login');