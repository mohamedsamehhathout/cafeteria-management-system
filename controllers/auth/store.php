<?php

use Core\Auth;
use Core\InputValidator;

$email = InputValidator::sanitizeEmail($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

$validator = validator()
    ->required('email', $email, 'Email')
    ->email('email', $email)
    ->required('password', $password, 'Password');

if ($validator->fails()) {
    redirect('/login?error=invalid_credentials');
}

$db = getDatabase();

$user = $db->query("SELECT * FROM users WHERE email = :email", ['email' => $email])->find();

if ($user && password_verify($password, $user['password'])) {
    Auth::login($user);
    redirect($user['role'] === 'admin' ? '/dashboard' : '/home');
}

redirect('/login?error=invalid_credentials');

