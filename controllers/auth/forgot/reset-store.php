<?php

use Core\InputValidator;

$password = $_POST['password'] ?? '';
$token = InputValidator::sanitizeString($_GET['token'] ?? '');

$validator = validator()
    ->required('password', $password, 'Password')
    ->minLength('password', $password, 6, 'Password');

if ($validator->fails() || empty($token)) {
    redirect('/login?error=invalid_reset');
}

$dbService = getDbService();

// TODO: Validate token from password_resets table
// $passwordReset = $dbService->findById('password_resets', ...);

// TODO: Check if token is valid and not expired
// if (!$passwordReset || $passwordReset['used'] || strtotime($passwordReset['expires_at']) < time()) {
//     redirect('/login?error=token_expired');
// }

// TODO: Update password and mark token as used
// $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
// $dbService->update('users', $passwordReset['user_id'], ['password' => $hashedPassword]);
// $dbService->update('password_resets', $passwordReset['id'], ['used' => 1]);

redirect('/login?success=password_reset');

