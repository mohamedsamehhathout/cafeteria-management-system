<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/navbar.php'); ?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Edit Category</h3>
        </div>
        <div class="card-body">
            <!-- Submit to the admin route -->
            <form action="/categories" method="POST">
                
                <!-- 1. Tell the router this is an UPDATE request -->
                <input type="hidden" name="_method" value="PATCH">
                
                <!-- 2. Send the specific Category ID secretly -->
                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <!-- 3. Pre-fill the input using the value attribute -->
                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($category['name'] ?? '', ENT_QUOTES) ?>" required>
                    
                    <!-- Display validation errors if they exist -->
                    <?php if (isset($errors['name'])) : ?>
                        <div class="text-danger mt-1" style="font-size: 13px;"><?= $errors['name'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <!-- Pre-fill the textarea by echoing between the tags -->
                    <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($category['description'] ?? '', ENT_QUOTES) ?></textarea>
                    
                    <!-- Display validation errors if they exist -->
                    <?php if (isset($errors['description'])) : ?>
                        <div class="text-danger mt-1" style="font-size: 13px;"><?= $errors['description'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/categories" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Update Category</button>
                </div>
                
            </form>
        </div>
    </div>
</div>

<?php require base_path('views/partials/footer.php'); ?>