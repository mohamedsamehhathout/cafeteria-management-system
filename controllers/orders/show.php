<?php

use Core\InputValidator;

adminOnly();

$status = InputValidator::sanitizeString($_GET['status'] ?? '');
$dateFrom = InputValidator::sanitizeString($_GET['date_from'] ?? '');
$dateTo = InputValidator::sanitizeString($_GET['date_to'] ?? '');

$filters = array_filter([
    'status' => $status,
    'date_from' => $dateFrom,
    'date_to' => $dateTo
]);

$orderService = getOrderService();
$orders = $orderService->getAllOrders($filters);

view('orders/admin-orders.view.php', [
    'pageTitle' => 'Orders',
    'orders' => $orders,
    'status' => $status,
    'dateFrom' => $dateFrom,
    'dateTo' => $dateTo
]);

