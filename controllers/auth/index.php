<?php
use Core\Auth;
use Core\Session;
if (Auth::check()) {

    if (Auth::isAdmin()) {
        redirect('/dashboard');
    }

    redirect('/home');
}

$errors = Session::get('errors', []);

Session::forget('errors');

$css = '<link rel="stylesheet" href="/css/auth/login.css">';


view('auth/login.view.php', [
    'pageTitle' => 'Login',
    'errors' => $errors,
    'css' => $css
]);