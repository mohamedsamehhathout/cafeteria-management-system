<?php
    $router->get('/', 'controllers/index.php');

    $router->get('/categories', 'controllers/categories/index.php');
    $router->get('/admin/categories/create', 'controllers/categories/create.php');
    $router->post('/categories', 'controllers/categories/store.php');

    $router->get('/admin/categories/edit', 'controllers/categories/edit.php');
    $router->patch('/categories', 'controllers/categories/update.php');

    $router->delete('/categories', 'controllers/categories/delete.php');

    $router->get('/products', 'controllers/products/index.php');
    $router->get('/products/create', 'controllers/products/create.php');
    $router->post('/products', 'controllers/products/store.php');

    $router->get('/product/edit', 'controllers/products/edit.php');
    $router->patch('/product', 'controllers/products/update.php');

    $router->delete('/products', 'controllers/products/delete.php');

        
        
    