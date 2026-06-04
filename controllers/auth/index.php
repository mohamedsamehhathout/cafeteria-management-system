<?php
use Core\Auth;

if (Auth::check()) {

    if (Auth::isAdmin()) {
        redirect('/dashboard');
    }

    redirect('/home');
}

view('auth/login.view.php', [
    'pageTitle' => 'Login'
]);