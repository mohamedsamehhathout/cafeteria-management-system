<?php

use Core\Auth;
use Core\InputValidator;

userOnly();

$orderId = InputValidator::sanitizeInt($_POST['order_id'] ?? 0);
$userId = Auth::user()['id'];

if (!$orderId) {
    redirect('/my-orders');
}

$orderService = getOrderService();

if ($orderService->cancelOrder($orderId, $userId)) {
    redirect('/my-orders?success=order_cancelled');
} else {
    redirect('/my-orders?error=cancel_failed');
}

