<?php

namespace Core;

/**
 * OrderService - Handles all order-related business logic
 * Eliminates duplication and centralizes business rules
 */
class OrderService
{
    private DatabaseService $database;

    public function __construct(DatabaseService $database)
    {
        $this->database = $database;
    }

    /**
     * Create a new order with items
     * Returns order ID on success, null on failure
     */
    public function createOrder(int $userId, ?int $roomId, string $notes, array $items): ?int
    {
        // Validate items
        if (empty($items)) {
            return null;
        }

        // Fetch and validate product prices
        $priceMap = $this->fetchProductPrices(array_column($items, 'id'));
        if (empty($priceMap)) {
            return null;
        }

        // Calculate total with validation
        $totalAmount = $this->calculateOrderTotal($items, $priceMap);
        if ($totalAmount <= 0) {
            return null;
        }

        // Create order
        $orderId = $this->database->insert('orders', [
            'user_id' => $userId,
            'room_id' => $roomId,
            'notes' => InputValidator::sanitizeString($notes),
            'total_amount' => $totalAmount,
            'status' => 'processing'
        ]);

        if (!$orderId) {
            return null;
        }

        // Create order items
        if (!$this->createOrderItems($orderId, $items, $priceMap)) {
            // Rollback: delete order if items failed
            $this->database->delete('orders', $orderId);
            return null;
        }

        return $orderId;
    }

    /**
     * Get all orders for a user
     */
    public function getUserOrders(int $userId): array
    {
        $orders = $this->database->query(
            "SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC",
            ['user_id' => $userId]
        );

        return $this->enrichOrdersWithItems($orders);
    }

    /**
     * Get all orders (admin view)
     */
    public function getAllOrders(array $filters = []): array
    {
        $conditions = ["1 = 1"];
        $params = [];

        if (!empty($filters['status'])) {
            $conditions[] = "orders.status = :status";
            $params['status'] = $filters['status'];
        }

        if (!empty($filters['date_from'])) {
            $conditions[] = "DATE(orders.created_at) >= :date_from";
            $params['date_from'] = $filters['date_from'];
        }

        if (!empty($filters['date_to'])) {
            $conditions[] = "DATE(orders.created_at) <= :date_to";
            $params['date_to'] = $filters['date_to'];
        }

        $where = implode(' AND ', $conditions);

        $orders = $this->database->query(
            "SELECT
                orders.id,
                orders.total_amount,
                orders.status,
                orders.notes,
                orders.created_at,
                users.name AS user_name,
                rooms.room_number
             FROM orders
             JOIN users ON users.id = orders.user_id
             LEFT JOIN rooms ON rooms.id = orders.room_id
             WHERE {$where}
             ORDER BY orders.created_at DESC",
            $params
        );

        return $this->enrichOrdersWithItems($orders);
    }

    /**
     * Update order status
     */
    public function updateOrderStatus(int $orderId, string $status): bool
    {
        $allowedStatuses = ['processing', 'out_for_delivery', 'done', 'cancelled'];

        if (!in_array($status, $allowedStatuses, true)) {
            return false;
        }

        return $this->database->update('orders', $orderId, ['status' => $status]);
    }

    /**
     * Cancel an order
     */
    public function cancelOrder(int $orderId, int $userId): bool
    {
        $order = $this->database->findById('orders', $orderId);

        if (!$order || $order['user_id'] !== $userId) {
            return false;
        }

        if (in_array($order['status'], ['done', 'cancelled'], true)) {
            return false;
        }

        return $this->updateOrderStatus($orderId, 'cancelled');
    }

    /**
     * Private helper: Fetch available product prices
     */
    private function fetchProductPrices(array $productIds): array
    {
        if (empty($productIds)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($productIds), '?'));
        $products = $this->database->query(
            "SELECT id, price FROM products WHERE id IN ({$placeholders}) AND is_available = 1",
            $productIds
        );

        $priceMap = [];
        foreach ($products as $product) {
            $priceMap[$product['id']] = (float) $product['price'];
        }

        return $priceMap;
    }

    /**
     * Private helper: Calculate order total
     */
    private function calculateOrderTotal(array $items, array $priceMap): float
    {
        $total = 0;

        foreach ($items as $item) {
            $productId = InputValidator::sanitizeInt($item['id'] ?? 0);
            $quantity = InputValidator::sanitizeInt($item['qty'] ?? 0);

            if (!isset($priceMap[$productId]) || $quantity <= 0) {
                continue;
            }

            $total += $priceMap[$productId] * $quantity;
        }

        return (float) $total;
    }

    /**
     * Private helper: Create order items
     */
    private function createOrderItems(int $orderId, array $items, array $priceMap): bool
    {
        foreach ($items as $item) {
            $productId = InputValidator::sanitizeInt($item['id'] ?? 0);
            $quantity = InputValidator::sanitizeInt($item['qty'] ?? 0);

            if (!isset($priceMap[$productId]) || $quantity <= 0) {
                continue;
            }

            $unitPrice = $priceMap[$productId];
            $subtotal = $unitPrice * $quantity;

            $itemId = $this->database->insert('order_items', [
                'order_id' => $orderId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal
            ]);

            if (!$itemId) {
                return false;
            }
        }

        return true;
    }

    /**
     * Private helper: Enrich orders with their items
     */
    private function enrichOrdersWithItems(array $orders): array
    {
        foreach ($orders as &$order) {
            $order['items'] = $this->database->query(
                "SELECT
                    order_items.quantity,
                    order_items.unit_price,
                    products.name
                 FROM order_items
                 JOIN products ON products.id = order_items.product_id
                 WHERE order_items.order_id = :order_id",
                ['order_id' => $order['id']]
            );
        }

        return $orders;
    }
}
