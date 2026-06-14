<?php

use Core\InputValidator;

$email = InputValidator::sanitizeEmail($_POST['email'] ?? '');

$validator = validator()
    ->required('email', $email, 'Email')
    ->email('email', $email);

if ($validator->fails()) {
    redirect('/forgot-password?error=invalid_email');
}

$dbService = getDbService();
$user = $dbService->query(
    "SELECT id FROM users WHERE email = :email",
    ['email' => $email]
);

if (!empty($user)) {
    // TODO: Send password reset email with token
    redirect('/login?success=reset_link_sent');
} else {
    redirect('/forgot-password?error=email_not_found');
}

