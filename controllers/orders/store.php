<?php

use Core\Database;

adminOnly();

$config = require base_path('config.php');

$db = new Database($config);

$errors = [];

$userId = $_POST['user_id'] ?? null;

$notes = trim($_POST['notes'] ?? '');

$cart = json_decode(
    $_POST['cart_json'] ?? '[]',
    true
);

if (! $userId) {

    $errors['user'] =
        'Please select a user.';
}

if (empty($cart)) {

    $errors['cart'] =
        'Please add at least one product.';
}

if (! empty($errors)) {

    $products = $db
        ->query("
            SELECT
                products.*,
                categories.name AS category_name
            FROM products
            LEFT JOIN categories
                ON categories.id = products.category_id
            WHERE products.is_available = 1
            ORDER BY products.name
        ")
        ->get();

    $users = $db
        ->query("
            SELECT
                users.*,
                rooms.room_number
            FROM users
            LEFT JOIN rooms
                ON rooms.id = users.room_id
        ")
        ->get();
$css = '<link rel="stylesheet" href="/css/orders/create.css">';
    view('orders/create.view.php', [

        'pageTitle' => 'Create Order',

        'products' => $products,

        'users' => $users,

        'errors' => $errors,

        'css' => $css

    ]);

    exit();
}

$user = $db
    ->query("
        SELECT *
        FROM users
        WHERE id = :id
    ", [

        'id' => $userId

    ])
    ->findOrFail();

$totalAmount = 0;
foreach ($cart as $item) {

    $totalAmount +=
        $item['price']
        *
        $item['quantity'];
}

$db->query("
    INSERT INTO orders (

        user_id,

        room_id,

        notes,

        total_amount,

        status

    )
    VALUES (

        :user_id,

        :room_id,

        :notes,

        :total_amount,

        'processing'

    )
", [

    'user_id' => $user['id'],

    'room_id' => $user['room_id'],

    'notes' => $notes,

    'total_amount' => $totalAmount

]);

$orderId =
    $db
        ->connection
        ->lastInsertId();

foreach ($cart as $item) {

    $subtotal =
        $item['price']
        *
        $item['quantity'];

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

        'order_id' => $orderId,

        'product_id' => $item['id'],

        'quantity' => $item['quantity'],

        'unit_price' => $item['price'],

        'subtotal' => $subtotal

    ]);
}

redirect('/orders');