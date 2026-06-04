<?php

namespace Core;

class Auth
{
    public static function user()
    {
        return Session::get('user');
    }

    public static function check()
    {
        return static::user() !== null;
    }

    public static function guest()
    {
        return ! static::check();
    }
    public static function isAdmin()
    {
        return static::user()['role'] === 'admin';
    }
    public static function isUser()
    {
        return static::user()['role'] === 'user';
    }
}