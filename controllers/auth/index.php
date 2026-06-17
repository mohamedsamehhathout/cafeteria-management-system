<?php
use Core\Auth;

if (Auth::check()) {

    if (Auth::isAdmin()) {
        redirect('/dashboard');
    }

    redirect('/home');
}
$css = '<link rel="stylesheet" href="/css/auth/login.css">';
view('auth/login.view.php', [
    'pageTitle' => 'Login',
    'css' => $css
]);