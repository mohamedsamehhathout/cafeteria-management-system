<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/navbar.php'); ?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Add New Category</h3>
        </div>
        <div class="card-body">
            <form action="/admin/categories" method="POST">
                
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/admin/categories" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Save Category</button>
                </div>
                
            </form>
        </div>
    </div>
</div>

<?php require base_path('views/partials/footer.php'); ?>