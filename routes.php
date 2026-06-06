<?php
    $router->get('/', 'controllers/index.php');

    $router->get('/categories', 'controllers/categories/index.php');
    $router->get('/categories/create', 'controllers/categories/create.php');
    $router->post('/categories', 'controllers/categories/store.php');
        
        
    