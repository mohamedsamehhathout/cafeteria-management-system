<?php
use Core\Auth;

if (Auth::check()) {

    if (Auth::user()['role'] === 'admin') {
        redirect('/dashboard');
    }

    redirect('/home');
}

view('auth/login.view.php', [
    'pageTitle' => 'Login'
]);