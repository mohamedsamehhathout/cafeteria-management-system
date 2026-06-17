<?php require base_path('views/partials/head.php'); ?>

<?php require base_path('views/partials/sidebar.php'); ?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <div class="page-body">

        
        <div class="stats-grid">

            <div class="stat-card">
                <div class="stat-icon">🍽️</div>

                <div>
                    <div class="stat-label">Products</div>
                    <div class="stat-value"><?= $productsCount ?></div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📁</div>

                <div>
                    <div class="stat-label">Categories</div>
                    <div class="stat-value"><?= $categoriesCount ?></div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">👥</div>

                <div>
                    <div class="stat-label">Users</div>
                    <div class="stat-value"><?= $usersCount ?></div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">⚡</div>

                <div>
                    <div class="stat-label">Orders</div>
                    <div class="stat-value"><?= $ordersCount ?></div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">⏳</div>

                <div>
                    <div class="stat-label">Processing</div>
                    <div class="stat-value"><?= $processingOrders ?></div>
                </div>
            </div>

        </div>
        <div class="card recent-orders-card">

            <div class="card-header">
                <h3>Recent Orders</h3>
            </div>

            <div class="card-body">

                <table class="dashboard-table">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Room</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($recentOrders as $order) : ?>

                            <tr>

                                <td>
                                    #<?= $order['id'] ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($order['name']) ?>
                                </td>

                                <td>
                                    <?= $order['room_number'] ?? '-' ?>
                                </td>

                                <td>
                                    EGP <?= $order['total_amount'] ?>
                                </td>

                                <td>

                                    <span class="status-badge status-<?= $order['status'] ?>">

                                        <?= ucfirst(str_replace('_', ' ', $order['status'])) ?>

                                    </span>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>
    </div>
</div>
<?php require base_path('views/partials/footer.php'); ?>