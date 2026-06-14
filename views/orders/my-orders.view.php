<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/sidebar-user.php'); ?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <div class="page-body">

        <!-- Filters -->
        <div class="filter-card">
            <form method="GET" action="/my-orders">
                <div class="filter-row">

                    <div class="filter-group">
                        <div class="filter-label">From Date</div>
                        <input
                            type="date"
                            name="date_from"
                            class="filter-input"
                            value="<?= htmlspecialchars($dateFrom) ?>"
                        >
                    </div>

                    <div class="filter-group">
                        <div class="filter-label">To Date</div>
                        <input
                            type="date"
                            name="date_to"
                            class="filter-input"
                            value="<?= htmlspecialchars($dateTo) ?>"
                        >
                    </div>

                    <div class="filter-group">
                        <div class="filter-label">Status</div>
                        <select name="status" class="filter-input">
                            <option value="">All Statuses</option>
                            <option value="processing"       <?= $status === 'processing'       ? 'selected' : '' ?>>Processing</option>
                            <option value="out_for_delivery" <?= $status === 'out_for_delivery' ? 'selected' : '' ?>>Out for Delivery</option>
                            <option value="done"             <?= $status === 'done'             ? 'selected' : '' ?>>Done</option>
                            <option value="cancelled"        <?= $status === 'cancelled'        ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-filter">🔍 Search</button>
                    <a href="/my-orders" class="btn-clear">Clear</a>

                </div>
            </form>
        </div>

        <!-- Orders Table -->
        <div class="table-card">

            <div class="table-header">
                <span class="table-title">Order History</span>
                <span class="orders-count"><?= count($orders) ?> orders</span>
            </div>

            <?php if (empty($orders)): ?>
                <div class="empty-state">
                    No orders found.
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date & Time</th>
                            <th>Items</th>
                            <th>Room</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>

                            <tr>
                                <td><span class="order-id">#<?= $order['id'] ?></span></td>

                                <td>
                                    <div class="date-main"><?= date('M d, Y', strtotime($order['created_at'])) ?></div>
                                    <div class="date-sub"><?= date('h:i A', strtotime($order['created_at'])) ?></div>
                                </td>

                                <td>
                                    <?= implode(', ', array_map(fn($i) => htmlspecialchars($i['name']), $order['items'])) ?>
                                </td>

                                <td>
                                    <?= $order['room_number'] ? 'Room ' . htmlspecialchars($order['room_number']) : '—' ?>
                                </td>

                                <td class="order-total">EGP <?= number_format($order['total_amount'], 2) ?></td>

                                <td>
                                    <?php
                                        $badgeClass = match($order['status']) {
                                            'processing'       => 'badge-processing',
                                            'out_for_delivery' => 'badge-delivery',
                                            'done'             => 'badge-done',
                                            'cancelled'        => 'badge-cancelled',
                                            default            => ''
                                        };
                                        $badgeLabel = match($order['status']) {
                                            'processing'       => '⏳ Processing',
                                            'out_for_delivery' => '🚚 Out for Delivery',
                                            'done'             => '✅ Done',
                                            'cancelled'        => '✕ Cancelled',
                                            default            => $order['status']
                                        };
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= $badgeLabel ?></span>
                                </td>

                                <td>
                                    <div style="display:flex; gap:6px;">
                                        <button class="expand-btn" onclick="toggleDetails(<?= $order['id'] ?>)">
                                            ▼ Details
                                        </button>

                                        <?php if ($order['status'] === 'processing'): ?>
                                            <form method="POST" action="/orders/cancel">
                                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                                <button type="submit" class="btn-cancel">✕ Cancel</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>

                            <!-- Expanded Details Row -->
                            <tr id="details-<?= $order['id'] ?>" style="display:none;">
                                <td colspan="7">
                                    <div class="expand-inner">
                                        <div class="expand-title">Order #<?= $order['id'] ?> — Item Details</div>

                                        <div class="order-items-grid">
                                            <?php foreach ($order['items'] as $item): ?>
                                                <div class="order-item-chip">
                                                    <span class="oi-emoji">🍽️</span>
                                                    <div class="oi-details">
                                                        <div class="oi-name"><?= htmlspecialchars($item['name']) ?></div>
                                                        <div class="oi-sub">
                                                            Qty: <?= $item['quantity'] ?> · EGP <?= number_format($item['unit_price'], 2) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                        <div class="expand-summary">
                                            <div class="sum-item">
                                                <div class="sum-label">Grand Total</div>
                                                <div class="sum-val total">EGP <?= number_format($order['total_amount'], 2) ?></div>
                                            </div>
                                        </div>

                                        <?php if ($order['notes']): ?>
                                            <div class="order-notes">
                                                📝 <?= htmlspecialchars($order['notes']) ?>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        </div>

    </div>

</div>

<script>
function toggleDetails(orderId) {
    const row = document.getElementById('details-' + orderId);
    row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
}
</script>

<?php require base_path('views/partials/footer.php'); ?>
