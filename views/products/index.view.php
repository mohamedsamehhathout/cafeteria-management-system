<?php

$pageTitle = 'Products';

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');

?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <main class="page-body">

        <div class="page-header">

            <h1 class="page-title">
                 Manage Products
            </h1>

            <a href="/products/create" class="btn btn-primary">
                + Add New Product
            </a>

        </div>

        <div class="table-card">

            

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

                    <?php foreach ($products as $product) : ?>

                        <tr>

                            <td>

                                <div class="prod-cell">

                                    <img
                                        src="<?= htmlspecialchars(
                                                $product['image'] ?? '/images/default-product.png',
                                                ENT_QUOTES
                                            ) ?>"
                                        alt="Product Photo"
                                        class="prod-thumb">

                                    <div>

                                        <div class="prod-cell-name">

                                            <?= htmlspecialchars($product['name'] ?? '', ENT_QUOTES) ?>

                                        </div>

                                        <div class="prod-cell-desc">

                                            <?= htmlspecialchars($product['description'] ?? '', ENT_QUOTES) ?>

                                        </div>

                                    </div>

                                </div>

                            </td>

                            <td>

                                <span class="price-badge">

                                    $<?= htmlspecialchars($product['price'] ?? '0.00', ENT_QUOTES) ?>

                                </span>

                            </td>

                            <td>

                                <span class="text-muted">

                                    <?= htmlspecialchars($product['category_name'] ?? 'Uncategorized', ENT_QUOTES) ?>

                                </span>

                            </td>

                            <td>

                                <div class="action-group">

                                    <a
                                        href="/product/edit?id=<?= $product['id'] ?>"
                                        class="act-btn act-edit">

                                        Edit

                                    </a>

                                    <form
                                        action="/products"
                                        method="POST"
                                        style="margin:0;"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');">

                                        <input
                                            type="hidden"
                                            name="_method"
                                            value="DELETE">

                                        <input
                                            type="hidden"
                                            name="id"
                                            value="<?= $product['id'] ?>">

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