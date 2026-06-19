<?php

$pageTitle = 'Create Category';

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');

?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <main class="page-body">

        <div class="page-header">

            <h2>
                Add New Category
            </h2>

        </div>

        <div class="form-card">

            <form action="/categories" method="POST">

                <div class="form-group">

                    <label>

                        Category Name

                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name" required>

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
                        class="form-control"></textarea>

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

                        Create Category

                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

<?php require base_path('views/partials/footer.php'); ?>