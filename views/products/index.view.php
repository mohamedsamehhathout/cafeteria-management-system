<?php require base_path('views/partials/head.php'); ?>

<?php require base_path('views/partials/sidebar-admin.php'); ?>

<div class="main-content">
    <?php require base_path('views/partials/navbar.php'); ?>

    <div class="page-body">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="topbar-title">🍽️ Products</h2>
            <a href="/products/create" class="act-btn act-edit">+ Add New Product</a>
        </div>

        <div class="table-card">
            <div class="tc-header">
                <div class="tc-title">All Products</div>
                <div class="tc-sub">Manage your menu items, pricing, and photos</div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td>
                                <div class="prod-cell">
                                    <img src="<?= htmlspecialchars($product['image'] ?? '/images/default-product.png', ENT_QUOTES) ?>" alt="Product Photo" class="prod-thumb">
                                    <div>
                                        <div class="prod-cell-name"><?= htmlspecialchars($product['name'] ?? '', ENT_QUOTES) ?></div>
                                        <div class="prod-cell-desc"><?= htmlspecialchars($product['description'] ?? '', ENT_QUOTES) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="price-badge">$<?= htmlspecialchars($product['price'] ?? '0.00', ENT_QUOTES) ?></span>
                            </td>
                            <td>
                                <span style="font-size: 13px; font-weight: 500; color: #666;">
                                    <?= htmlspecialchars($product['category_name'] ?? 'Uncategorized', ENT_QUOTES) ?>
                                </span>
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="/product/edit?id=<?= $product['id'] ?>" class="act-btn act-edit">✏️ Edit</a>
                                    <form action="/products" method="POST" style="margin: 0;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                        <button type="submit" class="act-btn act-del">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php require base_path('views/partials/footer.php'); ?>