<?php

namespace Core;

class Session
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function destroy()
    {
        $_SESSION = [];

        session_destroy();
    }
    public static function forget($key)
    {
        unset($_SESSION[$key]);
    }
}