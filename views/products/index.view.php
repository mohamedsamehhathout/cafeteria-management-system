<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/sidebar-admin.php'); ?>

<style>
    :root {
        --primary: #6F4E37;
        --secondary: #D9A066;
        --bg: #F8F5F2;
        --border: #E8E0D8;
        --shadow: 0 2px 20px rgba(111, 78, 55, .10);
    }

    .page-body {
        padding: 30px 40px;
    }

    .mb-4 {
        margin-bottom: 24px !important;
    }

    .d-flex {
        display: flex;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .align-items-center {
        align-items: center;
    }

    .topbar-title {
        font-size: 24px;
        font-weight: 800;
        color: #2C1A0E;
        margin: 0;
    }

    .table-card {
        background: #fff;
        border-radius: 14px;
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .tc-header {
        padding: 18px 24px;
        border-bottom: 1px solid var(--border);
    }

    .tc-title {
        font-size: 16px;
        font-weight: 700;
        color: #2C1A0E;
    }

    .tc-sub {
        font-size: 13px;
        color: #aaa;
        margin-top: 2px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead th {
        background: #FAFAF8;
        padding: 14px 24px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        color: #bbb;
        border-bottom: 2px solid var(--border);
    }

    tbody td {
        padding: 16px 24px;
        border-bottom: 1px solid var(--border);
        font-size: 14px;
        color: #444;
        vertical-align: middle;
    }

    tbody tr:hover td {
        background: #faf8f6;
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    .prod-cell {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .prod-thumb {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid var(--border);
        background-color: #f4f4f4;
    }

    .prod-cell-name {
        font-size: 14px;
        font-weight: 800;
        color: #2C1A0E;
    }

    .prod-cell-desc {
        font-size: 13px;
        color: #888;
        margin-top: 2px;
    }

    .price-badge {
        font-weight: 700;
        font-size: 15px;
        color: var(--primary);
    }

    .action-group {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .act-btn {
        padding: 8px 16px;
        border-radius: 6px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        border: 1.5px solid transparent;
        text-decoration: none;
        display: inline-block;
    }

    .act-btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        transition: all 0.2s;
    }

    .act-edit {
        background: rgba(111, 78, 55, .07);
        color: var(--primary);
        border-color: rgba(111, 78, 55, .18);
    }

    .act-del {
        background: rgba(220, 53, 69, .07);
        color: #DC3545;
        border-color: rgba(220, 53, 69, .18);
    }
</style>

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
                                    <a href="/products/edit?id=<?= $product['id'] ?>" class="act-btn act-edit">✏️ Edit</a>

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