<?php

use Core\Auth;
use Core\InputValidator;

userOnly();

$userId = Auth::user()['id'];
$status = InputValidator::sanitizeString($_GET['status'] ?? '');
$dateFrom = InputValidator::sanitizeString($_GET['date_from'] ?? '');
$dateTo = InputValidator::sanitizeString($_GET['date_to'] ?? '');

$filters = array_filter([
    'status' => $status,
    'date_from' => $dateFrom,
    'date_to' => $dateTo
]);

$orderService = getOrderService();
$orders = $orderService->getUserOrders($userId);

// Apply filters on user orders if needed
if (!empty($filters)) {
    $orders = array_filter($orders, function ($order) use ($filters) {
        if (!empty($filters['status']) && $order['status'] !== $filters['status']) {
            return false;
        }

        if (!empty($filters['date_from'])) {
            $orderDate = date('Y-m-d', strtotime($order['created_at']));
            if ($orderDate < $filters['date_from']) {
                return false;
            }
        }

        if (!empty($filters['date_to'])) {
            $orderDate = date('Y-m-d', strtotime($order['created_at']));
            if ($orderDate > $filters['date_to']) {
                return false;
            }
        }

        return true;
    });
}

view('orders/my-orders.view.php', [
    'pageTitle' => 'My Orders',
    'orders' => $orders,
    'status' => $status,
    'dateFrom' => $dateFrom,
    'dateTo' => $dateTo
]);

