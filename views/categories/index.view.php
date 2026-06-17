<?php require base_path('views/partials/head.php'); ?>

<div class="main-content">
    <?php require base_path('views/partials/navbar.php'); ?>

    <div class="page-body">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="topbar-title">📁 Categories Management</h2>
            <a href="/admin/categories/create" class="act-btn act-edit">+ Add New Category</a>
        </div>

        <div class="table-card">
            <div class="tc-header">
                <div class="tc-title">All Categories</div>
                <div class="tc-sub">Manage your menu categories</div>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <!-- The ID header was removed from here -->
                        <th>Category</th>
                        <th>Description</th>
                        <th>Products</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><div class="cat-cell-name"><?= htmlspecialchars($category['name'] ?? '', ENT_QUOTES) ?></div></td>
                            <td><div class="cat-cell-desc"><?= htmlspecialchars($category['description'] ?? '', ENT_QUOTES) ?></div></td>
                            <td>
                                <span style="font-weight:700;font-size:15px; color: var(--primary);">
                                    <?= htmlspecialchars($category['product_count'] ?? '0', ENT_QUOTES) ?>
                                </span>
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="/admin/categories/edit?id=<?= $category['id'] ?>" class="act-btn act-edit">✏️ Edit</a>
                                    
                                    <form action="/categories" method="POST" style="margin: 0;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="<?= $category['id'] ?>">
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