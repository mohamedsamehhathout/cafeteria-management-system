<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/sidebar-admin.php'); ?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <div class="content-area">

        <!-- Products Zone -->
        <div class="products-zone">

            <div class="zone-header">
                <div class="zone-title">
                    🍽️ Menu
                    <span class="zone-count">(<?= count($products) ?> items)</span>
                </div>

                <input
                    type="text"
                    id="search-input"
                    class="search-input"
                    placeholder="Search items..."
                >
            </div>

            <!-- Category Tabs -->
            <div class="cat-tabs">
                <div class="cat-tab active" data-category="all">All</div>

                <?php foreach ($categories as $category): ?>
                    <div class="cat-tab" data-category="<?= $category['id'] ?>">
                        <?= htmlspecialchars($category['name']) ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Products Grid -->
            <div class="prod-grid" id="products-grid">

                <?php foreach ($products as $product): ?>
                    <div
                        class="prod-card"
                        data-category="<?= $product['category_id'] ?>"
                        data-name="<?= strtolower(htmlspecialchars($product['name'])) ?>"
                        onclick="addToOrder(<?= $product['id'] ?>, '<?= htmlspecialchars($product['name'], ENT_QUOTES) ?>', <?= $product['price'] ?>)"
                    >
                        <div class="prod-img">🍽️</div>

                        <div class="prod-body">
                            <div class="prod-name"><?= htmlspecialchars($product['name']) ?></div>
                            <div class="prod-cat"><?= htmlspecialchars($product['category_name']) ?></div>
                            <div class="prod-price">EGP <?= number_format($product['price'], 2) ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>

        <!-- Order Panel -->
        <div class="order-panel">

            <div class="op-header">
                <div class="op-title">🧾 Order Builder</div>
                <div class="op-subtitle" id="op-subtitle">0 items</div>
            </div>

            <div class="op-items" id="op-items">
                <div class="op-empty" id="op-empty">
                    No items yet. Click a product to add it.
                </div>
            </div>

            <div class="op-footer">

                <form action="/orders/store" method="POST">

                    <!-- Customer selector -->
                    <div class="op-room">
                        <div class="op-label">Customer</div>
                        <select name="user_id" class="op-select" required>
                            <option value="">Select employee</option>
                            <?php foreach ($users as $user): ?>
                                <option value="<?= $user['id'] ?>">
                                    <?= htmlspecialchars($user['name']) ?>
                                    <?= $user['room_number'] ? '— Room ' . htmlspecialchars($user['room_number']) : '' ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="op-notes">
                        <div class="op-label">Special Notes</div>
                        <textarea name="notes" placeholder="Any special requests?"></textarea>
                    </div>

                    <!-- Hidden items input -->
                    <input type="hidden" name="items" id="items-input">
                    <input type="hidden" name="is_manual" value="1">

                    <div class="op-total">
                        <span class="op-total-label">Total Amount</span>
                        <span class="op-total-val" id="op-total">EGP 0.00</span>
                    </div>

                    <button type="submit" class="btn-confirm" id="btn-confirm" disabled>
                        ✓ Place Order
                    </button>

                    <a href="/orders" class="btn-clear" style="display:block; text-align:center; margin-top:8px;">
                        Cancel
                    </a>

                </form>

            </div>

        </div>

    </div>

</div>

<script>
const orderItems = {};

function addToOrder(id, name, price) {
    if (orderItems[id]) {
        orderItems[id].qty += 1;
    } else {
        orderItems[id] = { id, name, price, qty: 1 };
    }
    renderOrder();
}

function changeQty(id, delta) {
    if (!orderItems[id]) return;
    orderItems[id].qty += delta;
    if (orderItems[id].qty <= 0) delete orderItems[id];
    renderOrder();
}

function renderOrder() {
    const items     = Object.values(orderItems);
    const container = document.getElementById('op-items');
    const empty     = document.getElementById('op-empty');
    const subtitle  = document.getElementById('op-subtitle');
    const totalEl   = document.getElementById('op-total');
    const btnEl     = document.getElementById('btn-confirm');
    const inputEl   = document.getElementById('items-input');

    const totalQty    = items.reduce((s, i) => s + i.qty, 0);
    const totalAmount = items.reduce((s, i) => s + i.qty * i.price, 0);

    subtitle.textContent = totalQty + ' item' + (totalQty !== 1 ? 's' : '');
    totalEl.textContent  = 'EGP ' + totalAmount.toFixed(2);
    btnEl.disabled       = items.length === 0;
    inputEl.value        = JSON.stringify(items.map(i => ({ id: i.id, qty: i.qty })));

    container.querySelectorAll('.order-item').forEach(el => el.remove());

    if (items.length === 0) {
        empty.style.display = 'block';
        return;
    }

    empty.style.display = 'none';

    items.forEach(item => {
        const div = document.createElement('div');
        div.className = 'order-item';
        div.innerHTML = `
            <div class="oi-emoji">🍽️</div>
            <div class="oi-info">
                <div class="oi-name">${item.name}</div>
                <div class="oi-price">EGP ${item.price.toFixed(2)} each</div>
            </div>
            <div class="oi-qty">
                <button type="button" class="qty-btn" onclick="changeQty(${item.id}, -1)">−</button>
                <span class="qty-num">${item.qty}</span>
                <button type="button" class="qty-btn" onclick="changeQty(${item.id}, +1)">+</button>
            </div>
            <span class="oi-remove" onclick="changeQty(${item.id}, -${item.qty})">✕</span>
        `;
        container.appendChild(div);
    });
}

// Category filter
document.querySelectorAll('.cat-tab').forEach(tab => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        const category = tab.dataset.category;

        document.querySelectorAll('.prod-card').forEach(card => {
            const match = category === 'all' || card.dataset.category === category;
            card.style.display = match ? '' : 'none';
        });
    });
});

// Search filter
document.getElementById('search-input').addEventListener('input', function () {
    const query = this.value.toLowerCase();

    document.querySelectorAll('.prod-card').forEach(card => {
        const match = card.dataset.name.includes(query);
        card.style.display = match ? '' : 'none';
    });
});
</script>

<?php require base_path('views/partials/footer.php'); ?>
