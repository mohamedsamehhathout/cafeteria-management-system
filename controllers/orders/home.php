<?php
use Core\Auth;

if (! Auth::check()) {
    redirect('/login');
}

view('orders/home.view.php', [
    'pageTitle' => 'Home'
]);