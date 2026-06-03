<?php

use Core\Session;

if (! Session::get('reset_email')) {

    redirect('/forgot-password');
}

view('auth/reset-password.view.php', [
    'pageTitle' => 'Reset Password'
]);