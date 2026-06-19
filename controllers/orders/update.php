<?php
use Core\Database;

adminOnly();

$config = require base_path('config.php');

$db = new Database($config);

$order = $db
    ->query("
        SELECT *
        FROM orders
        WHERE id = :id
    ", [
        'id' => $_POST['id']
    ])
    ->findOrFail();

if ($order['status'] !== 'processing') {

    abort(403);
}

if (! empty($_POST['quantities'])) {

    foreach ($_POST['quantities'] as $itemId => $quantity) {

        $quantity = max(1, (int) $quantity);

        $item = $db
            ->query("
                SELECT unit_price
                FROM order_items
                WHERE id = :id
            ", [
                'id' => $itemId
            ])
            ->find();

        $subtotal =
            $quantity *
            $item['unit_price'];

        $db->query("
            UPDATE order_items
            SET
                quantity = :quantity,
                subtotal = :subtotal
            WHERE id = :id
        ", [

            'quantity' => $quantity,

            'subtotal' => $subtotal,

            'id' => $itemId

        ]);
    }
}

    if ($product) {

        $quantity =
            max(
                1,
                (int) $_POST['new_quantity']
            );

        $db->query("
            INSERT INTO order_items (

                order_id,

                product_id,

                quantity,

                unit_price,

                subtotal

            )
            VALUES (

                :order_id,

                :product_id,

                :quantity,

                :unit_price,

                :subtotal

            )
        ", [

            'order_id' => $order['id'],

            'product_id' => $product['id'],

            'quantity' => $quantity,

            'unit_price' => $product['price'],

            'subtotal' =>
                $quantity *
                $product['price']

        ]);
    }


if (! empty($_POST['added_products'])) {

    foreach (
        $_POST['added_products']
        as $product
    ) {

        $dbProduct = $db
            ->query("
                SELECT
                    id,
                    price
                FROM products
                WHERE id = :id
            ", [

                'id' =>
                    $product['product_id']

            ])
            ->find();

        $quantity =
            max(
                1,
                (int) $product['quantity']
            );

        $db->query("
            INSERT INTO order_items (

                order_id,
                product_id,
                quantity,
                unit_price,
                subtotal

            )
            VALUES (

                :order_id,
                :product_id,
                :quantity,
                :unit_price,
                :subtotal

            )
        ", [

            'order_id' =>
                $order['id'],

            'product_id' =>
                $dbProduct['id'],

            'quantity' =>
                $quantity,

            'unit_price' =>
                $dbProduct['price'],

            'subtotal' =>
                $quantity *
                $dbProduct['price']

        ]);
    }
}

$total = $db
    ->query("
        SELECT
            SUM(subtotal) total
        FROM order_items
        WHERE order_id = :id
    ", [
        'id' => $order['id']
    ])
    ->find();

$db->query("
    UPDATE orders
    SET total_amount = :total
    WHERE id = :id
", [

    'total' => $total['total'],

    'id' => $order['id']

]);
if (! empty($_POST['delete_items'])) {

    foreach ($_POST['delete_items'] as $itemId) {

        $db->query("
            DELETE
            FROM order_items
            WHERE id = :id
        ", [
            'id' => $itemId
        ]);
    }
    redirect(
    '/orders/edit?id='
    . $order['id']
);
}
redirect(
    '/orders/show?id='
    . $order['id']
);