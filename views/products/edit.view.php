<?php

$pageTitle = 'Edit Product';

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');

?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <div class="page-body">

        <div class="breadcrumb">

            <a href="/products">
                Products
            </a>

            <span>›</span>

            <span>
                Edit Products
            </span>

        </div>

        <div class="edit-alert">

            

            <p>

                You are editing

                <strong>
                    <?= htmlspecialchars($product['name']) ?>
                </strong>

                Product.

            </p>

        </div>

        <div class="form-layout">

            <div>

                <form method="POST" action="/users" enctype="multipart/form-data" autocomplete="off">

                    <input
                        type="hidden"
                        name="_method"
                        value="PATCH"
                    >

                    <input
                        type="hidden"
                        name="id"
                        value="<?= $product['id'] ?>"
                    >

                    <div class="form-card">

                        <div class="fc-header">

                            <div>

                                <h3>
                                    Product Information
                                </h3>

                                <p>
                                    Update product information
                                </p>

                            </div>

                        </div>

                        <div class="fc-body">

                            <div class="form-group">

                                <label class="form-label">

                                    Product Name

                                </label>

                                <input
                                    class="form-control"
                                    type="text"
                                    name="name"
                                    value="<?= htmlspecialchars($product['name']) ?>"
                                    required
                                    placeholder="e.g., Iced Caramel Macchiato">

                            </div>

                            <div class="form-group">

                                <label class="form-label">

                                    Category

                                </label>

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

                                    <p class="error">
                                        <?= $errors['category_id'] ?>
                                    </p>

                                <?php endif; ?>
                            </div>

                            

                                <div class="form-group">

                                    <label class="form-label">

                                        Price ($)

                                    </label>

                                    <input type="number" 
                                            id="price" 
                                            name="price" 
                                            step="0.01" 
                                            min="0" 
                                            placeholder="0.00"
                                            value="<?= $product['price'] ?>">
                                    <?php if (isset($errors['price'])) : ?>
                                        <div class="error-msg"><?= $errors['price'] ?></div>
                                    <?php endif; ?>

                                </div>

                                <div class="form-group">
                                    <label for="image">Product Image (Optional)</label>
                                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                    <?php if (isset($errors['image'])) : ?>
                                        <div class="error-msg"><?= $errors['image'] ?></div>
                                    <?php endif; ?>
                                </div>
                                
                                    
                                    <div class="current-img-text">
                                        <strong>Current File Path:</strong><br>
                                        <?= htmlspecialchars(!empty($product['image']) ? $product['image'] : 'Default Placeholder Active', ENT_QUOTES) ?>
                                    </div>
                                

                        </div>

                    </div>

                    

                    <button
                        type="submit"
                        class="btn-save"
                    >
                        Save Changes
                    </button>

                </form>

            </div>

            <div>

                <div class="profile-preview-card">

                    <div class="pp-header">

                        <h4>
                            Product View
                        </h4>

                    </div>

                    <div class="pp-body">

                        <?php 
                                        $displayImg = (!empty($product['image'])) ? $product['image'] : '/images/default-product.png'; 
                                    ?>
                                    <img src="<?= htmlspecialchars($displayImg, ENT_QUOTES) ?>" 
                                        alt="Product Image" 
                                        class="product-image">

                        <div class="pp-name">

                            <?= htmlspecialchars($product['name']) ?>

                        </div>

                        

                        <div class="pp-tags">

                            <span class="pp-tag tag-employee">

                                <?= ucfirst($product['price'] . "$") ?>

                            </span>

                        </div>

                        
                            <div style="margin-top:8px;">

                                <strong>Created:</strong>

                                <?= $product['created_at'] ?>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="form-card">

                    <div class="fc-body">

                        <a
                            href="/products"
                            class="btn-cancel"
                            style="
                                display:block;
                                text-align:center;
                                text-decoration:none;
                            "
                        >

                            Cancel

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php require base_path('views/partials/footer.php'); ?>