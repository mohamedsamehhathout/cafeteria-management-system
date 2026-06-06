<?php
    $router->get('/', 'controllers/index.php');

    $router->get('/categories', 'controllers/categories/index.php');
    $router->get('/admin/categories/create', 'controllers/categories/create.php');
    $router->post('/categories', 'controllers/categories/store.php');

    $router->get('/admin/categories/edit', 'controllers/categories/edit.php');
    $router->patch('/categories', 'controllers/categories/update.php');

    $router->delete('/categories', 'controllers/categories/delete.php');



        
        
    