<?php

$pageTitle = 'User Details';

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');
?>
<style>
    .main{margin-left:240px;}
</style>
<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

<div class="user-details-wrapper">

    <div class="user-card">

        <div class="user-header">

            <div class="user-avatar-large">
                <?= strtoupper(substr($this_user['name'], 0, 1)) ?>
            </div>

            <div class="user-info">

                <h2><?= htmlspecialchars($this_user['name']) ?></h2>

                <p><?= htmlspecialchars($this_user['email']) ?></p>

                <span class="role-badge">
                    <?= ucfirst($this_user['role']) ?>
                </span>

            </div>

        </div>

        <div class="details-grid">

            <div class="detail-box">
                <div class="detail-label">Room</div>
                <div class="detail-value">
                    <?= $this_user['room_number'] ?? 'No Room' ?>
                </div>
            </div>

            <div class="detail-box">
                <div class="detail-label">Extension</div>
                <div class="detail-value">
                    <?= $this_user['extension'] ?>
                </div>
            </div>

            <div class="detail-box">
                <div class="detail-label">Created At</div>
                <div class="detail-value">
                    <?= $this_user['created_at'] ?>
                </div>
            </div>

            <div class="detail-box">
                <div class="detail-label">User ID</div>
                <div class="detail-value">
                    #<?= $this_user['id'] ?>
                </div>
            </div>

        </div>

        <div class="user-actions">

            <a
                href="/users/edit?id=<?= $this_user['id'] ?>"
                class="btn-edit"
            >
                Edit User
            </a>

            <a
                href="/users"
                class="btn-back-user"
            >
                Back
            </a>

        </div>

    </div>

</div>

<?php require base_path('views/partials/footer.php'); ?>