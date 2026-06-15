<?php

$pageTitle = 'Add User';

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');
?>
<style>
    .page-content{
        padding: 28px;
    }

    .page-header{
        margin-bottom: 24px;
        margin-left: 200px;
    }

    .page-header h2{
        color:#2C1A0E;
        font-size:28px;
        font-weight:700;
    }

    .form-card{
        background:#fff;
        border-radius:14px;
        border:1px solid #E8E0D8;
        box-shadow:0 2px 20px rgba(111,78,55,.10);
        max-width:800px;
        overflow:hidden;
        margin-left: 200px;
    }

    .form-card form{
        padding:24px;
    }

    .form-group{
        margin-bottom:20px;
    }

    .form-group label{
        display:block;
        margin-bottom:8px;
        font-size:12px;
        font-weight:700;
        color:#4A3020;
        text-transform:uppercase;
    }

    .form-group input,
    .form-group select{
        width:100%;
        padding:12px 14px;
        border:2px solid #E8E0D8;
        border-radius:10px;
        font-size:14px;
        outline:none;
        transition:.2s;
        background:#fafafa;
    }

    .form-group input:focus,
    .form-group select:focus{
        border-color:#6F4E37;
        background:#fff;
    }

    .btn-save{
        width:100%;
        padding:14px;
        border:none;
        border-radius:10px;
        cursor:pointer;
        background:linear-gradient(
            135deg,
            #6F4E37,
            #8B6347
        );
        color:#fff;
        font-size:15px;
        font-weight:700;
    }
</style>
<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <main class="page-content">

        <div class="page-header">
            <h2>Add User</h2>
        </div>

        <div class="form-card">

            <form method="POST" action="/users">

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
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
                                <?= $room['room_number'] ?>
                            </option>

                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="form-group">
                    <label>Extension</label>
                    <input type="text" name="extension">
                </div>

                <button type="submit" class="btn-save">
                    Create User
                </button>

            </form>

        </div>

    </main>

</div>

<?php require base_path('views/partials/footer.php'); ?>