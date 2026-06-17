<?php

$pageTitle = 'Edit User';

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');

?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <div class="page-body">

        <div class="breadcrumb">

            <a href="/users">
                Users
            </a>

            <span>›</span>

            <span>
                Edit User
            </span>

        </div>

        <div class="edit-alert">

            <span style="font-size:20px;">✏️</span>

            <p>

                You are editing

                <strong>
                    <?= htmlspecialchars($this_user['name']) ?>
                </strong>

                account.

            </p>

        </div>

        <div class="form-layout">

            <div>

                <form method="POST" action="/users">

                    <input
                        type="hidden"
                        name="_method"
                        value="PATCH"
                    >

                    <input
                        type="hidden"
                        name="id"
                        value="<?= $this_user['id'] ?>"
                    >

                    <div class="form-card">

                        <div class="fc-header">

                            <div>

                                <h3>
                                    Account Information
                                </h3>

                                <p>
                                    Update user information
                                </p>

                            </div>

                        </div>

                        <div class="fc-body">

                            <div class="form-group">

                                <label class="form-label">

                                    Full Name

                                </label>

                                <input
                                    class="form-control"
                                    type="text"
                                    name="name"
                                    value="<?= htmlspecialchars($this_user['name']) ?>"
                                    required
                                >

                            </div>

                            <div class="form-group">

                                <label class="form-label">

                                    Email Address

                                </label>

                                <input
                                    class="form-control"
                                    type="email"
                                    name="email"
                                    value="<?= htmlspecialchars($this_user['email']) ?>"
                                    required
                                >
                                <?php if (isset($errors['email'])) : ?>

                                    <p class="error">
                                        <?= $errors['email'] ?>
                                    </p>

                                <?php endif; ?>
                            </div>

                            <div class="form-row">

                                <div class="form-group">

                                    <label class="form-label">

                                        Role

                                    </label>

                                    <select
                                        class="form-control"
                                        name="role"
                                    >

                                        <option
                                            value="user"
                                            <?= $this_user['role'] === 'user'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            User
                                        </option>

                                        <option
                                            value="admin"
                                            <?= $this_user['role'] === 'admin'
                                                ? 'selected'
                                                : '' ?>
                                        >
                                            Admin
                                        </option>

                                    </select>

                                </div>

                                <div class="form-group">

                                    <label class="form-label">

                                        Room

                                    </label>

                                    <select name="room_id" class="form-control">

                                        <?php foreach ($rooms as $room) : ?>

                                            <option
                                                value="<?= $room['id'] ?>"
                                                <?= $room['id'] == $this_user['room_id']
                                                    ? 'selected'
                                                    : '' ?>>

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
                                        class="form-control">
                                    <label class="form-label">Room Description</label>
                                    <input
                                        type="text"
                                        name="room_description"
                                        class="form-control">

                                </div>
                            </div>

                            <div class="form-group">

                                <label class="form-label">

                                    Extension

                                </label>
                                
                                <input
                                    class="form-control"
                                    type="text"
                                    name="extension"
                                    value="<?= $this_user['extension'] ?>"
                                >

                            </div>

                        </div>

                    </div>

                    <div class="form-card">

                        <div class="fc-header">

                            <div>

                                <h3>
                                    Reset Password
                                </h3>

                                <p>
                                    Leave blank to keep current password
                                </p>

                            </div>

                        </div>

                        <div class="fc-body">

                            <div class="form-group">

                                <label class="form-label">

                                    New Password

                                </label>

                                <input
                                    class="form-control"
                                    type="password"
                                    name="password"
                                    placeholder="Leave blank to keep current password"
                                >
                                <?php if (isset($errors['password'])) : ?>

                                    <p class="error">
                                        <?= $errors['password'] ?>
                                    </p>

                                <?php endif; ?>

                            </div>

                        </div>

                    </div>

                    <button
                        type="submit"
                        class="btn-save"
                    >
                        Save Changes
                    </button>

                </form>

            </div>

            <div>

                <div class="profile-preview-card">

                    <div class="pp-header">

                        <h4>
                            👤 User Profile
                        </h4>

                    </div>

                    <div class="pp-body">

                        <div class="pp-avatar">

                            <?= strtoupper(substr($this_user['name'], 0, 1)) ?>

                        </div>

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

                <div class="form-card">

                    <div class="fc-body">

                        <a
                            href="/users"
                            class="btn-cancel"
                            style="
                                display:block;
                                text-align:center;
                                text-decoration:none;
                            "
                        >

                            Cancel

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<script>
    const roomSelect = document.querySelector('[name="room_id"]');

    const newRoomWrapper =
        document.getElementById('new-room-wrapper');

    roomSelect.addEventListener('change', function () {

        if (this.value === 'new') {

            newRoomWrapper.style.display = 'block';

        } else {

            newRoomWrapper.style.display = 'none';
        }

    });
</script>
<?php require base_path('views/partials/footer.php'); ?>