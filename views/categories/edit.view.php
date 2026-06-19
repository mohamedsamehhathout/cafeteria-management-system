<?php

$pageTitle = 'Categories';

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');

?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <main class="page-body">

        <div class="page-header">

            <h2>
                Edit Category
            </h2>

        </div>

        <div class="form-card">

            <form action="/categories" method="POST">

                <input
                    type="hidden"
                    name="_method"
                    value="PATCH">

                <input
                    type="hidden"
                    name="id"
                    value="<?= $category['id'] ?>">

                <div class="form-group">

                    <label>

                        Category Name

                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?= htmlspecialchars($category['name'] ?? '', ENT_QUOTES) ?>" required>

                    <?php if (isset($errors['name'])) : ?>

                        <div class="error-msg">

                            <?= $errors['name'] ?>

                        </div>

                    <?php endif; ?>

                </div>

                <div class="form-group">

                    <label>

                        Description

                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="form-control"><?= htmlspecialchars($category['description'] ?? '', ENT_QUOTES) ?></textarea>

                    <?php if (isset($errors['description'])) : ?>

                        <div class="error-msg">

                            <?= $errors['description'] ?>

                        </div>

                    <?php endif; ?>

                </div>

                <div class="btn-group">

                    

                    <button
                        type="submit"
                        class="btn-save">

                        Update Category

                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<?php require base_path('views/partials/footer.php'); ?>