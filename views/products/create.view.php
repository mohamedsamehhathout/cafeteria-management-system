<?php 
require_once base_path('views/partials/head.php'); 
require_once base_path('views/partials/sidebar-admin.php'); 
?>

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

.form-card { 
    background: #251c16; 
    border-radius: 14px; 
    border: 1px solid var(--border); 
    box-shadow: var(--shadow); 
    padding: 30px;
    max-width: 600px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 8px;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border-radius: 8px;
    border: 1px solid var(--border);
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    color: #fff;
    background-color: #1e1510;
    box-sizing: border-box;
    transition: border-color 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: var(--secondary);
}

select.form-control option {
    background-color: #ffffff;
    color: #2C1A0E;
}

.error-msg {
    color: #DC3545;
    font-size: 13px;
    font-weight: 500;
    margin-top: 6px;
}

.btn-group {
    display: flex;
    gap: 12px;
    margin-top: 30px;
}

.act-btn { 
    padding: 12px 24px; 
    border-radius: 8px; 
    font-family: 'Poppins', sans-serif; 
    font-size: 14px; 
    font-weight: 600; 
    cursor: pointer; 
    border: 1.5px solid transparent; 
    text-decoration: none; 
    display: inline-block;
    text-align: center;
}

.act-btn:hover { 
    opacity: 0.9; 
    transform: translateY(-1px); 
    transition: all 0.2s; 
}

.btn-submit { 
    background: var(--secondary); 
    color: #2C1A0E; 
}

.btn-cancel { 
    background: transparent; 
    color: #fff; 
    border-color: var(--border); 
}
</style>

<div class="main-content">
    <?php require base_path('views/partials/navbar.php'); ?>

    <div class="page-body">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="topbar-title">➕ Add New Product</h2>
        </div>

        <div class="form-card">
            <form action="/products" method="POST" enctype="multipart/form-data" autocomplete="off">
                
                <div class="form-group">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-control" 
                           placeholder="e.g., Iced Caramel Macchiato"
                           value="<?= htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES) ?>">
                    <?php if (isset($errors['name'])) : ?>
                        <div class="error-msg">⚠️ <?= $errors['name'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="category_id" class="form-label">Category</label>
                    <select id="category_id" name="category_id" class="form-control">
                        <option value="">-- Select a Category --</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['id'] ?>" 
                                <?= (isset($_POST['category_id']) && $_POST['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name'], ENT_QUOTES) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['category_id'])) : ?>
                        <div class="error-msg">⚠️ <?= $errors['category_id'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Price ($)</label>
                    <input type="number" 
                           id="price" 
                           name="price" 
                           step="0.01" 
                           min="0" 
                           class="form-control" 
                           placeholder="0.00"
                           value="<?= htmlspecialchars($_POST['price'] ?? '', ENT_QUOTES) ?>">
                    <?php if (isset($errors['price'])) : ?>
                        <div class="error-msg">⚠️ <?= $errors['price'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Product Image (Optional)</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    <?php if (isset($errors['image'])) : ?>
                        <div class="error-msg">⚠️ <?= $errors['image'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="btn-group">
                    <button type="submit" class="act-btn btn-submit">Save Product</button>
                    <a href="/products" class="act-btn btn-cancel">Cancel</a>
                </div>

            </form>
        </div>

    </div>
</div>

<?php require_once base_path('views/partials/footer.php'); ?>