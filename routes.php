<?php
    $router->get('/', 'controllers/index.php');
    $router->get('/login', 'Controllers/auth/index.php');
    $router->post('/login', 'Controllers/auth/store.php');

    $router->post('/logout', 'Controllers/auth/destroy.php');
    $router->get('/dashboard', 'Controllers/admin/dashboard.php');

    $router->get('/home', 'Controllers/orders/home.php');
