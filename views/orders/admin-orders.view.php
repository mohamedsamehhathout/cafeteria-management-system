<?php

$pageTitle = 'Orders';

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');

?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <main class="page-body">

        <div class="page-header">

            <h1 class="page-title">
                Active Orders
            </h1>

        </div>
        <div class="live-bar">

            <div class="live-stat">

                <div class="live-number">
                    <?= count($processingOrders) ?>
                </div>

                <div class="live-label">
                    Processing
                </div>

            </div>

            <div class="live-stat">

                <div class="live-number">
                    <?= count($deliveryOrders) ?>
                </div>

                <div class="live-label">
                    Delivery
                </div>

            </div>

            <div class="live-stat">

                <div class="live-number">
                    <?= count($doneOrders) ?>
                </div>

                <div class="live-label">
                    Done
                </div>

            </div>

        </div>
        <div class="kanban">

            <!-- Processing -->

            <div class="lane processing">

                <div class="lane-header">

                    <span class="lane-title">
                        ⏳ Processing
                    </span>

                    <span class="lane-count">
                        <?= count($processingOrders) ?>
                    </span>

                </div>

                <div class="lane-body">

                    <?php foreach ($processingOrders as $order) : ?>

                        <a
                            href="/orders/show?id=<?= $order['id'] ?>"
                            class="order-card-link">

                            <div class="order-card">

                            <div class="order-top">

                                <h4>
                                    #<?= $order['id'] ?>
                                </h4>

                                <span class="status-badge processing">
                                    Processing
                                </span>

                            </div>

                            <p>
                                👤 <?= htmlspecialchars($order['user_name']) ?>
                            </p>

                            <p>
                                🏢 Room <?= htmlspecialchars($order['room_number'] ?? '-') ?>
                            </p>
                            <div class="order-items">

                            <?php foreach ($order['items'] as $item) : ?>

                                <div class="order-item-row">

                                    <span>
                                        <?= htmlspecialchars($item['name']) ?>
                                    </span>

                                    <span>
                                        x<?= $item['quantity'] ?>
                                    </span>

                                </div>

                            <?php endforeach; ?>

                        </div>
                            </a>

                            <p>
                                💰 <?= number_format($order['total_amount'], 2) ?> EGP
                            </p>

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

                                    <button
                                        type="submit"
                                        class="btn btn-primary">

                                        🚚 Send

                                    </button>
                                    
                                </form>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>
                            

            <!-- Delivery -->

            <div class="lane delivery">

                <div class="lane-header">

                    <span class="lane-title">
                        🚚 Out For Delivery
                    </span>

                    <span class="lane-count">
                        <?= count($deliveryOrders) ?>
                    </span>

                </div>

                <div class="lane-body">

                    <?php foreach ($deliveryOrders as $order) : ?>

                        <div class="order-card">

                            <div class="order-top">

                                <h4>
                                    #<?= $order['id'] ?>
                                </h4>

                                <span class="status-badge delivery">
                                    Delivery
                                </span>

                            </div>

                            <p>
                                👤 <?= htmlspecialchars($order['user_name']) ?>
                            </p>

                            <p>
                                🏢 Room <?= htmlspecialchars($order['room_number'] ?? '-') ?>
                            </p>

                            <p>
                                💰 <?= number_format($order['total_amount'], 2) ?> EGP
                            </p>

                            <div class="order-actions">

                                <form action="/orders/status" method="POST">

                                    <input
                                        type="hidden"
                                        name="order_id"
                                        value="<?= $order['id'] ?>">

                                    <input
                                        type="hidden"
                                        name="status"
                                        value="done">

                                    <button
                                        type="submit"
                                        class="btn btn-success">

                                        ✅ Done

                                    </button>

                                </form>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

            <!-- Done -->

            <div class="lane done">

                <div class="lane-header">

                    <span class="lane-title">
                        ✅ Completed
                    </span>

                    <span class="lane-count">
                        <?= count($doneOrders) ?>
                    </span>

                </div>

                <div class="lane-body">

                    <?php foreach ($doneOrders as $order) : ?>

                        <div class="order-card completed">

                            <div class="order-top">

                                <h4>
                                    #<?= $order['id'] ?>
                                </h4>

                                <span class="status-badge done">
                                    Done
                                </span>

                            </div>

                            <p>
                                👤 <?= htmlspecialchars($order['user_name']) ?>
                            </p>

                            <p>
                                🏢 Room <?= htmlspecialchars($order['room_number'] ?? '-') ?>
                            </p>

                            <p>
                                💰 <?= number_format($order['total_amount'], 2) ?> EGP
                            </p>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>

    </main>

</div>

<?php require base_path('views/partials/footer.php'); ?>