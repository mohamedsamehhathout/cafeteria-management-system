
<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/sidebar.php'); ?>

<div class="main">

<?php require base_path('views/partials/navbar.php'); ?>

<div class="page-body">

    <div >

                    <div class="pp-header">

                        <h4>
                            User Profile
                        </h4>

                    </div>

                    <div class="pp-body">

                        <?php 
                                        $displayImg = (!empty($profile['image'])) ? $profile['image'] : '/images/default-product.png'; 
                                    ?>
                                    <img src="<?= htmlspecialchars($displayImg, ENT_QUOTES) ?>" 
                                        alt="Profile Image" 
                                        class="profile-image">

                        <div class="pp-name">

                            <?= htmlspecialchars($profile['name']) ?>

                        </div>

                        <div class="pp-email">

                            <?= htmlspecialchars($profile['email']) ?>

                        </div>

                        <div class="pp-tags">

                            <span class="pp-tag tag-employee" style="background-color: #6f4e37; color: white;">

                                <?= ucfirst($profile['role']) ?>

                            </span>

                        </div>

                        <div
                            style="
                                margin-top:15px;
                                padding-top:15px;
                                border-top:1px solid var(--border);
                            "
                        >

                            <div>

                                <strong>Room:</strong>

                                <?= $profile['room_number'] ?>

                            </div>

                            <div style="margin-top:8px;">

                                <strong>Extension:</strong>

                                <?= $profile['extension'] ?>

                            </div>

                            <div style="margin-top:8px;">

                                <strong>Created:</strong>

                                <?= $profile['created_at'] ?>

                            </div>

                        </div>

                    </div>

                </div>

    </div>

</div>

</div>

<?php require base_path('views/partials/footer.php'); ?>