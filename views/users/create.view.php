<?php

$pageTitle = 'Add User';

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');
?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <main class="page-content">

        <div class="page-header">
            <h2>Add User</h2>
        </div>

        <div class="form-card">

            <form method="POST" action="/users" enctype="multipart/form-data" autocomplete="off">

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" required>
                
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                    <?php if (isset($errors['email'])) : ?>

                        <p class="error">
                            <?= $errors['email'] ?>
                        </p>

                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                    <?php if (isset($errors['password'])) : ?>

                        <p class="error">
                            <?= $errors['password'] ?>
                        </p>

                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Role</label>

                    <select name="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Room</label>
                    <select name="room_id">

                        <?php foreach($rooms as $room): ?>

                            <option value="<?= $room['id'] ?>">
                                <?= htmlspecialchars($room['room_number']) ?>
                            </option>

                            

                        <?php endforeach; ?>
                        <option value="new">
                                + Add New Room
                            </option>
                    </select>
                </div>
                <div id="new-room-wrapper" style="display:none;">

                    <label class="form-label">New Room</label>

                    <input
                        type="text"
                        name="new_room"
                        class="form-control"
                        placeholder="Enter room number">
                        <label class="form-label">Room Description</label>
                        <input
                            type="text"
                            name="room_description"
                            class="form-control"
                            placeholder="Enter room description">

                </div>
                <div class="form-group">
                    <label>Extension</label>
                    <input type="text" name="extension">
                </div>
                <div class="form-group">
                    <label for="image">User Image</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    <?php if (isset($errors['image'])) : ?>
                        <div class="error-msg"><?= $errors['image'] ?></div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn-save">
                    Create User
                </button>

            </form>

        </div>

    </main>

</div>

<?php require base_path('views/partials/footer.php'); ?>