<?php

$pageTitle = 'Create Category';

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');

?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <main class="page-body">

        <div class="page-header">

            <h1 class="page-title">
                Add New Category
            </h1>

        </div>

        <div class="form-card">

            <form action="/categories" method="POST">

                <div class="form-group">

                    <label
                        for="name"
                        class="form-label">

                        Category Name

                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        value="<?= htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES) ?>">

                    <?php if (isset($errors['name'])) : ?>

                        <div class="error-msg">

                            ⚠️ <?= $errors['name'] ?>

                        </div>

                    <?php endif; ?>

                </div>

                <div class="form-group">

                    <label
                        for="description"
                        class="form-label">

                        Description

                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="form-control"><?= htmlspecialchars($_POST['description'] ?? '', ENT_QUOTES) ?></textarea>

                    <?php if (isset($errors['description'])) : ?>

                        <div class="error-msg">

                            ⚠️ <?= $errors['description'] ?>

                        </div>

                    <?php endif; ?>

                </div>

                <div class="btn-group">

                    <a
                        href="/categories"
                        class="act-btn btn-cancel">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="act-btn btn-submit">

                        Save Category

                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<?php require base_path('views/partials/footer.php'); ?>