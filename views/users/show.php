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



    <div>

                    

                    <div class="pp-body">

                        <?php 
                                        $displayImg = (!empty($this_user['image'])) ? $this_user['image'] : '/images/default-product.png'; 
                                    ?>
                                    <img src="<?= htmlspecialchars($displayImg, ENT_QUOTES) ?>" 
                                        alt="Profile Image" 
                                        class="profile-image">

                        <div class="pp-name">

                            <?= htmlspecialchars($this_user['name']) ?>

                        </div>

                        <div class="pp-email">

                            <?= htmlspecialchars($this_user['email']) ?>

                        </div>

                        <div class="pp-tags">

                            <span class="pp-tag tag-employee">

                                <?= ucfirst($this_user['role']) ?>

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

                                <?= $this_user['room_number'] ?>

                            </div>

                            <div style="margin-top:8px;">

                                <strong>Extension:</strong>

                                <?= $this_user['extension'] ?>

                            </div>

                            <div style="margin-top:8px;">

                                <strong>Created:</strong>

                                <?= $this_user['created_at'] ?>

                            </div>

                        </div>

                    </div>

                </div>

   

        <div class="user-actions">

            <a
                href="/users/edit?id=<?= $this_user['id'] ?>"
                class="btn-edit" style="color: white;"
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


<?php require base_path('views/partials/footer.php'); ?>