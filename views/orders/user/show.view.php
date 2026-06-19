<?php

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');

?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <main class="page-body">

        <div class="page-header">

            <h1 class="page-title">

                Order #<?= $order['id'] ?>

            </h1>

        </div>

        <div class="form-card">

            <div class="order-details-card">

    <div class="order-info">

        <div class="info-box">

            <div class="info-label">
                Order ID
            </div>

            <div class="info-value">
                #<?= $order['id'] ?>
            </div>

        </div>

        <div class="info-box">

            <div class="info-label">
                Status
            </div>

            <div class="info-value">

                <span class="status-pill status-<?= str_replace('_', '-', $order['status']) ?>">

                    <?= ucwords(str_replace('_', ' ', $order['status'])) ?>

                </span>

            </div>

        </div>

        <div class="info-box">

            <div class="info-label">
                Customer
            </div>

            <div class="info-value">
                <?= htmlspecialchars($order['user_name']) ?>
            </div>

        </div>

        <div class="info-box">

            <div class="info-label">
                Room
            </div>

            <div class="info-value">
                <?= htmlspecialchars($order['room_number'] ?? '-') ?>
            </div>

        </div>

    </div>

    <div class="order-notes">

        <h4>
            Notes
        </h4>

        <p>

            <?= $order['notes'] ?: 'No notes provided.' ?>

        </p>

    </div>

    <table class="order-items-table">

        <thead>

            <tr>

                <th>Product</th>

                <th>Quantity</th>

                <th>Unit Price</th>

                <th>Subtotal</th>

            </tr>

        </thead>

        <tbody>

            <?php foreach ($items as $item) : ?>

                <tr>

                    <td>
                        <?= htmlspecialchars($item['name']) ?>
                    </td>

                    <td>
                        <?= $item['quantity'] ?>
                    </td>

                    <td>
                        <?= number_format($item['unit_price'], 2) ?> EGP
                    </td>

                    <td>
                        <?= number_format($item['subtotal'], 2) ?> EGP
                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

    <div class="order-total">

        Total:
        <?= number_format($order['total_amount'], 2) ?>
        EGP

    </div>

    <?php if ($order['status'] === 'processing') : ?>

        <div class="order-actions">

            <form action="/orders/status" method="POST">

                <input
                    type="hidden"
                    name="order_id"
                    value="<?= $order['id'] ?>">

                <input
                    type="hidden"
                    name="status"
                    value="out_for_delivery">

                <a
                    href="/orders/user/edit?id=<?= $order['id'] ?>"
                    class="act-btn act-edit" style="text-decoration: none; display: block; background-color: #6f4e37;">

                    Edit Order

                </a>

                

            </form>

            <form action="/orders/user/status" method="POST">

                <input
                    type="hidden"
                    name="order_id"
                    value="<?= $order['id'] ?>">

                <input
                    type="hidden"
                    name="status"
                    value="cancelled">

                <button
                    class="act-btn act-del" style="padding: 12px;">

                    Cancel Order

                </button>

            </form>

        </div>

    <?php endif; ?>

</div>
        </div>

    </main>

</div>