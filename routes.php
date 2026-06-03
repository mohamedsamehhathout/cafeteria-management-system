<?php
    $router->get('/', 'controllers/index.php');
    $router->get('/login', 'controllers/auth/index.php');
    $router->post('/login', 'controllers/auth/store.php');

    $router->post('/logout', 'controllers/auth/destroy.php');
    $router->get('/dashboard', 'controllers/admin/dashboard.php');

    $router->get('/home', 'controllers/orders/home.php');
    $router->post('/logout', 'controllers/auth/destroy.php');

    $router->get('/forgot-password', 'controllers/auth/forgot/index.php');
    $router->post('/forgot-password', 'controllers/auth/forgot/check.php');

    $router->get('/reset-password', 'controllers/auth/forgot/reset-index.php');
    $router->post('/reset-password', 'controllers/auth/forgot/reset-store.php');