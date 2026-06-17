<?php

use Core\Database;

adminOnly();

$config = require base_path('config.php');

$db = new Database($config);

$from = $_GET['from'] ?? date('Y-m-01');
$to = $_GET['to'] ?? date('Y-m-d');



$totalOrders = $db
    ->query(
        "
        SELECT COUNT(*) AS total
        FROM orders
        WHERE DATE(created_at)
        BETWEEN :from AND :to
        ",
        [
            'from' => $from,
            'to' => $to
        ]
    )
    ->find()['total'];

$completedOrders = $db
    ->query(
        "
        SELECT COUNT(*) AS total
        FROM orders
        WHERE status = 'done'
        AND DATE(created_at)
        BETWEEN :from AND :to
        ",
        [
            'from' => $from,
            'to' => $to
        ]
    )
    ->find()['total'];

$revenue = $db
    ->query(
        "
        SELECT COALESCE(SUM(total_amount),0) AS revenue
        FROM orders
        WHERE DATE(created_at)
        BETWEEN :from AND :to
        ",
        [
            'from' => $from,
            'to' => $to
        ]
    )
    ->find()['revenue'];



$orderLogs = $db
    ->query(
        "
        SELECT
            orders.id,
            users.name,
            orders.status,
            orders.total_amount,
            orders.created_at
        FROM orders
        JOIN users
            ON users.id = orders.user_id
        WHERE DATE(orders.created_at)
        BETWEEN :from AND :to
        ORDER BY orders.created_at DESC
        ",
        [
            'from' => $from,
            'to' => $to
        ]
    )
    ->get();



$newProducts = $db
    ->query(
        "
        SELECT *
        FROM products
        WHERE DATE(created_at)
        BETWEEN :from AND :to
        ORDER BY created_at DESC
        ",
        [
            'from' => $from,
            'to' => $to
        ]
    )
    ->get();

$css = '<link rel="stylesheet" href="/css/reports/reports.css">';
view('reports/index.view.php', [

    'pageTitle' => 'Reports',

    'from' => $from,
    'to' => $to,

    'totalOrders' => $totalOrders,
    'completedOrders' => $completedOrders,
    'revenue' => $revenue,

    'orderLogs' => $orderLogs,
    'newProducts' => $newProducts,
    'css' => $css

]);