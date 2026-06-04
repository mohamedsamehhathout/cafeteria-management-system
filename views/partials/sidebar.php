<?php

use Core\Auth;

$user = Auth::user();

if (Auth::isAdmin()) {

    require base_path('views/partials/sidebar-admin.php');

} else {

    require base_path('views/partials/sidebar-user.php');
}