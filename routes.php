<?php

// Auth
$router->get('/login',           'controllers/auth/index.php');
$router->post('/login',          'controllers/auth/store.php');
$router->get('/logout',          'controllers/auth/destroy.php');
$router->get('/forgot-password', 'controllers/auth/forgot/index.php');
$router->post('/forgot-password','controllers/auth/forgot/check.php');
$router->get('/reset-password',  'controllers/auth/forgot/reset-index.php');
$router->post('/reset-password', 'controllers/auth/forgot/reset-store.php');

// Admin
$router->get('/dashboard',       'controllers/admin/dashboard.php');

// Profile
$router->get('/profile',         'controllers/profile/show.php');

// Orders - User
$router->get('/home',            'controllers/orders/home.php');
$router->post('/orders/store',   'controllers/orders/store.php');
$router->get('/my-orders',       'controllers/orders/my-orders.php');
$router->post('/orders/cancel',  'controllers/orders/cancel.php');

// Orders - Admin
$router->get('/orders',                'controllers/orders/show.php');
$router->post('/orders/update-status', 'controllers/orders/update-status.php');
$router->get('/manual-order',          'controllers/orders/manual-order.php');

// Products
$router->get('/products',        'controllers/products/index.php');

// Categories
$router->get('/categories',      'controllers/categories/index.php');

// Users
$router->get('/users',           'controllers/users/index.php');

// Reports
$router->get('/reports',         'controllers/reports/index.php');