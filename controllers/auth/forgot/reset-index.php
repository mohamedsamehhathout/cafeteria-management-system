<?php

use Core\Session;

if (! Session::get('reset_email')) {

    redirect('/forgot-password');
}
$css = '<link rel="stylesheet" href="/css/auth/reset.css">';
view('auth/reset-password.view.php', [
    'pageTitle' => 'Reset Password',
    'css' => $css
]);