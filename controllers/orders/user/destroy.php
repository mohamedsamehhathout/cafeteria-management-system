<?php

use Core\Database;
use Core\Auth;

userOnly();

$config = require base_path('config.php');

$db = new Database($config);

$db->query("
    DELETE FROM order_items
    WHERE id = :id
", [

    'id' => $_POST['item_id']

]);

redirect(
    '/orders/user/edit?id=' .
    $_POST['order_id']
);