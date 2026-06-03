<?php

use Core\Database;
use Core\Session;

$config = require base_path('config.php');

$db = new Database($config);

$email = $_POST['email'];

$user = $db
    ->query(
        "SELECT * FROM users WHERE email = :email",
        [
            'email' => $email
        ]
    )
    ->find();

if (! $user) {
    
    redirect('/forgot-password');
}

Session::put('reset_email', $email);

redirect('/reset-password');