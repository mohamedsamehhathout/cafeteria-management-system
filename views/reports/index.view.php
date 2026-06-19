<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/sidebar.php'); ?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <main class="page-body">

        

        <div class="table-card">

            <form method="GET" action="/reports">

                <div class="form-row">

                    <div class="form-group">

                        <label>
                            From Date
                        </label>

                        <input
                            type="date"
                            name="from"
                            value="<?= $from ?>">

                    </div>

                    <div class="form-group">

                        <label>
                            To Date
                        </label>

                        <input
                            type="date"
                            name="to"
                            value="<?= $to ?>">

                    </div>

                    <div class="form-group">

                        <label>&nbsp;</label>

                        <button
                            type="submit"
                            class="btn btn-primary" style="background-color: #6f4e37;">

                            Generate Report

                        </button>

                    </div>

                </div>

            </form>

        </div>

        <div class="grid grid-stats">

            <div class="stat-card">

                <div class="stat-label">
                    Total Orders
                </div>

                <div class="stat-value">
                    <?= $totalOrders ?>
                </div>

            </div>

            <div class="stat-card">

                <div class="stat-label">
                    Completed Orders
                </div>

                <div class="stat-value">
                    <?= $completedOrders ?>
                </div>

            </div>

            <div class="stat-card">

                <div class="stat-label">
                    Revenue
                </div>

                <div class="stat-value">
                    <?= number_format($revenue, 2) ?>
                </div>

            </div>

        </div>

        <div class="table-card">

            <h2>
                Orders During Period
            </h2>

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Date</th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach ($orderLogs as $order) : ?>

                    <tr>

                        <td>
                            #<?= $order['id'] ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($order['name']) ?>
                        </td>

                        <td>
                            <?= ucfirst($order['status']) ?>
                        </td>

                        <td>
                            <?= number_format($order['total_amount'], 2) ?>
                        </td>

                        <td>
                            <?= $order['created_at'] ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <div class="table-card">

            <h2>
                New Products Added
            </h2>

            <?php if (empty($newProducts)) : ?>

                <p>
                    No products were added during this period.
                </p>

            <?php else : ?>

                <ul>

                <?php foreach ($newProducts as $product) : ?>

                    <li>

                        <?= htmlspecialchars($product['name']) ?>

                    </li>

                <?php endforeach; ?>

                </ul>

            <?php endif; ?>

        </div>

    </main>

</div>

<?php require base_path('views/partials/footer.php'); ?>