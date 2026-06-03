<?php
use Core\Auth;

if (! Auth::check()) {
    redirect('/login');
}

if (Auth::user()['role'] !== 'admin') {
    abort(403);
}

view('admin/dashboard.php', [
    'pageTitle' => 'Dashboard'
]);