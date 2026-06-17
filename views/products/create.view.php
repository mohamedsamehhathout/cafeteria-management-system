<?php 
$pageTitle = "Create Product";
require_once base_path('views/partials/head.php'); 
require_once base_path('views/partials/sidebar.php'); 
?>

<div class="main">
    <?php require base_path('views/partials/navbar.php'); ?>

    <div class="page-body">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="topbar-title"> Add New Product</h2>
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