<?php require base_path('views/partials/head.php'); ?>

<?php require base_path('views/partials/sidebar-user.php'); ?>

<div class="main-content">
    <?php require base_path('views/partials/navbar.php'); ?>

    <div class="page-body">
        <div class="card">
            <div class="card-header">
                <h3>My Profile</h3>
            </div>

            <div class="card-body">
                <?php if (\Core\Auth::isAuthenticated()): ?>
                    <?php $user = \Core\Auth::user(); ?>

                    <div style="max-width: 600px;">
                        <div style="margin: 20px 0;">
                            <label style="font-weight: bold;">Name</label>
                            <p><?= htmlspecialchars($user['name']) ?></p>
                        </div>

                        <div style="margin: 20px 0;">
                            <label style="font-weight: bold;">Email</label>
                            <p><?= htmlspecialchars($user['email']) ?></p>
                        </div>

                        <div style="margin: 20px 0;">
                            <label style="font-weight: bold;">Role</label>
                            <p><?= ucfirst(htmlspecialchars($user['role'])) ?></p>
                        </div>

                        <div style="margin: 20px 0;">
                            <label style="font-weight: bold;">Extension</label>
                            <p><?= htmlspecialchars($user['extension'] ?? 'N/A') ?></p>
                        </div>

                        <div style="margin: 20px 0;">
                            <label style="font-weight: bold;">Member Since</label>
                            <p><?= htmlspecialchars($user['created_at'] ?? 'N/A') ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <p>Please log in to view your profile.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require base_path('views/partials/footer.php'); ?>
