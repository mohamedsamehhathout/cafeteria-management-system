<?php

use Core\Router;
const BASE_PATH = __DIR__ . "/../";

require_once BASE_PATH . "Core/functions.php";

spl_autoload_register(function ($class) {
    // $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $class = str_replace("\\", "/", $class);
    // dd($class);
    require base_path("{$class}.php");
});
// require_once base_path("Core/router.php");

$router = new Router();

require base_path("routes.php");

$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Handle both local development and production paths
if (strpos($requestPath, '/cafeteria-management-system/public') === 0) {
    $url = str_replace('/cafeteria-management-system/public', '', $requestPath);
} else {
    // For localhost development, just use the path directly
    $url = $requestPath;
}

// Ensure URL starts with /
if (empty($url)) {
    $url = '/';
}

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($url, $method);
