<?php

use Core\InputValidator;

adminOnly();

$orderId = InputValidator::sanitizeInt($_POST['order_id'] ?? 0);
$status = InputValidator::sanitizeString($_POST['status'] ?? '');

if (!$orderId || empty($status)) {
    redirect('/orders');
}

$orderService = getOrderService();

if ($orderService->updateOrderStatus($orderId, $status)) {
    redirect('/orders?success=status_updated');
} else {
    redirect('/orders?error=status_update_failed');
}

