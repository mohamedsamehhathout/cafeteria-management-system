
<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/sidebar.php'); ?>

<div class="main-content">

<?php require base_path('views/partials/navbar.php'); ?>

<div class="page-body">

    <div class="card">

        <div class="card-header">
            <h3>My Profile</h3>
        </div>

        <div class="card-body">

            <h2><?= htmlspecialchars($user['name']) ?></h2>

            <p>Email: <?= htmlspecialchars($user['email']) ?></p>

            <p>Role: <?= ucfirst($user['role']) ?></p>

            <p>Extension: <?= $user['extension'] ?? '-' ?></p>

            <p>Room: <?= $user['room_number'] ?? '-' ?></p>

        </div>

    </div>

</div>

</div>

<?php require base_path('views/partials/footer.php'); ?>