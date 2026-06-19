<?php

use Core\Database;

adminOnly();

$config = require base_path('config.php');

$db = new Database($config);

$db->query("
    UPDATE orders
    SET status = :status
    WHERE id = :id
", [

    'status' => $_POST['status'],

    'id' => $_POST['order_id']

]);

redirect(
    '/orders'
);