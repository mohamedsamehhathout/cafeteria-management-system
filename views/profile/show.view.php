
<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/sidebar.php'); ?>

<div class="main">

<?php require base_path('views/partials/navbar.php'); ?>

<div class="page-body">

    <div class="card">

        <div class="card-header">
            <h3>My Profile</h3>
        </div>

        <div class="card-body">

            <h2><?= htmlspecialchars($profile['name']) ?></h2>
            <p>Email: <?= htmlspecialchars($profile['email']) ?></p>

            <p>Role: <?= ucfirst($profile['role']) ?></p>
            

            <p>Extension: <?= htmlspecialchars($profile['extension'] ?? '-') ?></p>

            <p>Room: <?= htmlspecialchars($profile['room_number'] ?? '-') ?></p>

        </div>

    </div>

</div>

</div>

<?php require base_path('views/partials/footer.php'); ?>