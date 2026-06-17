<?php 
$pageTitle = "Products";
require_once base_path('views/partials/head.php'); 
require_once base_path('views/partials/sidebar.php'); 
?>



<div class="main">
    <?php require base_path('views/partials/navbar.php'); ?>

    <div class="page-body">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="topbar-title">Edit Product: <?= htmlspecialchars($product['name'], ENT_QUOTES) ?></h2>
        </div>

        <div class="form-card">
            <form action="/product" method="POST" enctype="multipart/form-data" autocomplete="off">
                
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="<?= $product['id'] ?>">

                <div class="form-group">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-control" 
                           value="<?= htmlspecialchars($_POST['name'] ?? $product['name'], ENT_QUOTES) ?>">
                    <?php if (isset($errors['name'])) : ?>
                        <div class="error-msg">⚠️ <?= $errors['name'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="category_id" class="form-label">Category</label>
                    <select id="category_id" name="category_id" class="form-control">
                        <?php foreach ($categories as $category) : ?>
                            <?php 
                                $currentCategory = $_POST['category_id'] ?? $product['category_id'];
                                $selected = ($currentCategory == $category['id']) ? 'selected' : '';
                            ?>
                            <option value="<?= $category['id'] ?>" <?= $selected ?>>
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
                           value="<?= htmlspecialchars($_POST['price'] ?? $product['price'], ENT_QUOTES) ?>">
                    <?php if (isset($errors['price'])) : ?>
                        <div class="error-msg">⚠️ <?= $errors['price'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Change Product Image (Optional)</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    
                    <div class="current-img-container">
                        <?php 
                            $displayImg = (!empty($product['image'])) ? $product['image'] : '/images/default-product.png'; 
                        ?>
                        <img src="<?= htmlspecialchars($displayImg, ENT_QUOTES) ?>" 
                             alt="Current Thumbnail" 
                             class="current-img-thumb">
                        <div class="current-img-text">
                            <strong>Current File Path:</strong><br>
                            <?= htmlspecialchars(!empty($product['image']) ? $product['image'] : 'Default Placeholder Active', ENT_QUOTES) ?>
                        </div>
                    </div>

                    <?php if (isset($errors['image'])) : ?>
                        <div class="error-msg">⚠️ <?= $errors['image'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="btn-group">
                    <button type="submit" class="act-btn btn-submit">Update Product</button>
                    <a href="/products" class="act-btn btn-cancel">Cancel</a>
                </div>

            </form>
        </div>

    </div>
</div>

<?php require_once base_path('views/partials/footer.php'); ?>