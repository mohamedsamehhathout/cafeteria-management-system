<?php
    $router->get('/', 'controllers/index.php');
    $router->get('/login', 'controllers/auth/index.php');
    $router->post('/login', 'controllers/auth/store.php');

    $router->post('/logout', 'controllers/auth/destroy.php');
    $router->get('/dashboard', 'controllers/admin/dashboard.php');

    $router->get('/home', 'controllers/orders/user/home.php');
    $router->post('/logout', 'controllers/auth/destroy.php');

    $router->get('/forgot-password', 'controllers/auth/forgot/index.php');
    $router->post('/forgot-password', 'controllers/auth/forgot/check.php');

    $router->get('/reset-password', 'controllers/auth/forgot/reset-index.php');
    $router->post('/reset-password', 'controllers/auth/forgot/reset-store.php');
    $router->get('/profile', 'controllers/profile/show.php');

    $router->get('/reports', 'controllers/reports/index.php');
    $router->get('/products', 'controllers/products/index.php');
    $router->get('/categories', 'controllers/categories/index.php');
    $router->get('/orders', 'controllers/orders/index.php');
    $router->get('/orders/show', 'controllers/orders/show.php');
    $router->get('/orders/user/show', 'controllers/orders/user/show.php');

    $router->get('/orders/edit', 'controllers/orders/edit.php');
    $router->get('/orders/user/edit', 'controllers/orders/user/edit.php');

$router->patch('/orders', 'controllers/orders/update.php');
$router->delete('/order-item', 'controllers/orders/destroy.php');
$router->post('/orders/status', 'controllers/orders/status.php');
$router->post('/orders/user/status', 'controllers/orders/user/status.php');
$router->get('/orders/create', 'controllers/orders/create.php');

$router->post('/orders', 'controllers/orders/store.php');
$router->post('/home', 'controllers/orders/user/store.php');
    
    $router->get('/my-orders', 'controllers/orders/user/index.php');
    $router->patch('/my-orders', 'controllers/orders/user/update.php');


    $router->get('/users', 'controllers/users/index.php');
    $router->get('/user', 'controllers/users/show.php');

    $router->get('/users/create', 'controllers/users/create.php');
    $router->post('/users', 'controllers/users/store.php');
    
    $router->delete('/users', 'controllers/users/destroy.php');

    $router->get('/users/edit', 'controllers/users/edit.php');
    $router->patch('/users', 'controllers/users/update.php');

    $router->get('/categories', 'controllers/categories/index.php');
    $router->get('/categories/create', 'controllers/categories/create.php');
    $router->post('/categories', 'controllers/categories/store.php');

    $router->get('/categories/edit', 'controllers/categories/edit.php');
    $router->patch('/categories', 'controllers/categories/update.php');

    $router->delete('/categories', 'controllers/categories/destroy.php');

    $router->get('/products', 'controllers/products/index.php');
    $router->get('/products/create', 'controllers/products/create.php');
    $router->post('/products', 'controllers/products/store.php');

    $router->get('/product/edit', 'controllers/products/edit.php');
    $router->patch('/product', 'controllers/products/update.php');

    $router->delete('/products', 'controllers/products/destroy.php');

        
        
    