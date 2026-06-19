<?php

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');

?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <main class="page-body">

        <div class="page-header">

            <h1 class="page-title">

                My Orders

            </h1>

        </div>

        <div class="orders-grid">

            <?php foreach ($orders as $order) : ?>

                <a
                    href="/orders/user/show?id=<?= $order['id'] ?>"
                    class="order-card-link">

                    <div class="order-card">

                        <div class="order-card-header">

                            <h3>

                                Order #<?= $order['id'] ?>

                            </h3>

                            <span class="status-badge status-<?= $order['status'] ?>">

                                <?= ucfirst(str_replace('_', ' ', $order['status'])) ?>

                            </span>

                        </div>
                        
                        
                        <div class="order-card-body">
                        <div>

                            <h4>Count: </h4>

                            <?= $order['items_count'] ?>

                            Items

                        </div>
                            <div>

                                <h4>Salary: </h4>
                                <?= number_format($order['total_amount'], 2) ?>
                                EGP

                            </div>

                            <div>

                                <h4>Date: </h4>
                                <?= date('d M Y', strtotime($order['created_at'])) ?>

                            </div>

                        </div>

                    </div>

                </a>

            <?php endforeach; ?>

        </div>

    </main>

</div>