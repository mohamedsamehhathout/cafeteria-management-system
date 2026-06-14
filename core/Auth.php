<?php

namespace Core;

use Core\Database;

class Auth
{
    public static function user()
    {
        return $_SESSION['user'] ?? null;
    }

    public static function isAuthenticated()
    {
        return isset($_SESSION['user']);
    }

    public static function isAdmin()
    {
        return self::isAuthenticated() && self::user()['role'] === 'admin';
    }

    public static function login($user)
    {
        $_SESSION['user'] = $user;
    }

    public static function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
    }
}
