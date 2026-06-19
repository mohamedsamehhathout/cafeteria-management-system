<?php 
$pageTitle = "Categories";
require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');
?>

<div class="main">
    <?php require base_path('views/partials/navbar.php'); ?>

        <main class="page-body">

            <div class="page-header">

                <h1 class="page-title">
                    Manage Categories
                </h1>

                <a href="/categories/create" class="btn btn-primary">
                    Add New Category
                </a>

            </div>

            <div class="table-card">

                

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

                        <?php foreach ($categories as $category) : ?>

                            <tr>

                                <td>

                                    <div class="cat-cell-name">

                                        <?= htmlspecialchars(
                                            $category['name'] ?? '',
                                            ENT_QUOTES
                                        ) ?>

                                    </div>

                                </td>

                                <td>

                                    <div class="cat-cell-desc">

                                        <?= htmlspecialchars(
                                            $category['description'] ?? '',
                                            ENT_QUOTES
                                        ) ?>

                                    </div>

                                </td>

                                <td>

                                    <span class="price-badge">

                                        <?= htmlspecialchars(
                                            $category['product_count'] ?? '0',
                                            ENT_QUOTES
                                        ) ?>

                                    </span>

                                </td>

                                <td>

                                    <div class="action-group">

                                        <a
                                            href="/categories/edit?id=<?= $category['id'] ?>"
                                            class="act-btn act-edit">

                                            Edit

                                        </a>

                                        <form
                                            action="/categories"
                                            method="POST"
                                            style="margin:0;"
                                            onsubmit="return confirm('Are you sure you want to delete this category?');">

                                            <input
                                                type="hidden"
                                                name="_method"
                                                value="DELETE">

                                            <input
                                                type="hidden"
                                                name="id"
                                                value="<?= $category['id'] ?>">

                                            <button
                                                type="submit"
                                                class="act-btn act-del">

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

    </main>
</div>

<?php require base_path('views/partials/footer.php'); ?>