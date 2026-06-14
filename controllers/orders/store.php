<?php

use Core\Auth;

userOnly();

$userId = Auth::user()['id'];
$roomId = InputValidator::sanitizeInt($_POST['room_id'] ?? 0) ?: null;
$notes = InputValidator::sanitizeString($_POST['notes'] ?? '');
$items = json_decode($_POST['items'] ?? '[]', true);

if (!is_array($items)) {
    $items = [];
}

$orderService = getOrderService();
$orderId = $orderService->createOrder($userId, $roomId, $notes, $items);

if ($orderId) {
    redirect('/my-orders');
} else {
    redirect('/home?error=order_failed');
}

