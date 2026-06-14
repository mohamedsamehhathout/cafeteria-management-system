<?php

use Core\Response;
use Core\Auth;
use Core\Session;
use Core\Database;
use Core\DatabaseService;
use Core\OrderService;
use Core\InputValidator;

Session::start();

function dd($value)
{
    if (is_array($value) || is_object($value)) {
        echo "<h2> <pre>";
        var_dump($value);
        echo "</h2> </pre>";
    } else {
        echo $value;
    }
    die();
}

function urlIS($url)
{
    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    return $requestUri === $url;
}

function abort($code = Response::NOT_FOUND)
{
    http_response_code($code);
    require base_path("views/errors/{$code}.php");
    die();
}

function authorize($conditon, $status = Response::FORBIDDEN)
{
    if (!$conditon) {
        abort($status);
    }
}


function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path("views/{$path}");
}


function redirect($path)
{
    header("location: $path");
    exit();
}

function userOnly()
{
    if (!Auth::isAuthenticated()) {
        redirect('/login');
    }
}

function adminOnly()
{
    if (!Auth::isAdmin()) {
        abort(Response::FORBIDDEN);
    }
}

function getDatabase(): Database
{
    $config = require base_path('config.php');
    return new Database($config);
}

function getDbService(): DatabaseService
{
    return new DatabaseService(getDatabase());
}

function getOrderService(): OrderService
{
    return new OrderService(getDbService());
}

function validator(): InputValidator
{
    return new InputValidator();
}
