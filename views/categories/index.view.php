<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/sidebar-admin.php'); ?>

<style>
:root {
    --primary: #6F4E37;
    --secondary: #D9A066;
    --bg: #F8F5F2;
    --border: #E8E0D8;
    --shadow: 0 2px 20px rgba(111,78,55,.10);
}

.page-body { padding: 30px 40px; }
.mb-4 { margin-bottom: 24px !important; }
.d-flex { display: flex; }
.justify-content-between { justify-content: space-between; }
.align-items-center { align-items: center; }

.topbar-title { font-size: 24px; font-weight: 800; color: #2C1A0E; margin: 0; }

.table-card { 
    background: #251c16; 
    border-radius: 14px; 
    border: 1px solid var(--border); 
    box-shadow: var(--shadow); 
    overflow: hidden; 
}
.tc-header { padding: 18px 24px; border-bottom: 1px solid var(--border); }
.tc-title { font-size: 16px; font-weight: 700; color: #fff; }
.tc-sub { font-size: 13px; color: #aaa; margin-top: 2px; }

table { width: 100%; border-collapse: collapse; }
thead th { 
    background: #1e1510; 
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
    color: #fff; 
    vertical-align: middle; 
}
tbody tr:hover td { background: #2d221a; }
tbody tr:last-child td { border-bottom: none; }

.cat-cell-name { font-size: 14px; font-weight: 800; color: #fff; }
.cat-cell-desc { font-size: 13px; color: #ccc; margin-top: 4px; }

.action-group { display: flex; gap: 8px; align-items: center; }
.act-btn { padding: 8px 16px; border-radius: 6px; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; cursor: pointer; border: 1.5px solid transparent; text-decoration: none; display: inline-block; }
.act-btn:hover { opacity: 0.9; transform: translateY(-1px); transition: all 0.2s; }
.act-edit { background: rgba(217,160,102,.15); color: var(--secondary); border-color: rgba(217,160,102,.3); }
.act-del { background: rgba(220,53,69,.15); color: #DC3545; border-color: rgba(220,53,69,.3); }

</style>

<div class="main-content">
    <?php require base_path('views/partials/navbar.php'); ?>

    <div class="page-body">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="topbar-title">📂 Categories Management</h2>
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
                                <span style="font-weight: 800; font-size: 15px; color: var(--secondary);">
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