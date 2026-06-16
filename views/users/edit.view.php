<?php

$pageTitle = 'Edit User';

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');

?>
<style>
:root{--primary:#6F4E37;--secondary:#D9A066;--bg:#F8F5F2;--sidebar:#2C1A0E;--border:#E8E0D8;--shadow:0 2px 20px rgba(111,78,55,.10);}
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Poppins',sans-serif;background:var(--bg);display:flex;min-height:100vh;}
.sidebar{width:240px;background:var(--sidebar);display:flex;flex-direction:column;flex-shrink:0;min-height:100vh;}
.sidebar-logo{padding:22px 20px;border-bottom:1px solid rgba(255,255,255,.08);}
.logo-name{font-size:19px;font-weight:800;color:#fff;}.logo-name span{color:var(--secondary);}
.logo-sub{font-size:10px;color:rgba(255,255,255,.4);letter-spacing:1px;text-transform:uppercase;}
.nav-link{display:flex;align-items:center;gap:11px;padding:10px 20px;color:rgba(255,255,255,.6);text-decoration:none;font-size:13px;font-weight:500;border-left:3px solid transparent;}
.nav-link.active{color:var(--secondary);background:rgba(217,160,102,.12);border-left-color:var(--secondary);}
.nav-section{font-size:10px;font-weight:600;letter-spacing:1.5px;color:rgba(255,255,255,.3);padding:12px 20px 4px;text-transform:uppercase;}
.sidebar-user{padding:14px 20px;border-top:1px solid rgba(255,255,255,.08);display:flex;align-items:center;gap:10px;margin-top:auto;}
.s-avatar{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#D9A066,#B8824A);display:flex;align-items:center;justify-content:center;font-weight:700;color:#fff;font-size:13px;}
.main{flex:1;display:flex;flex-direction:column;margin-left:240px;}
.topbar{background:#fff;border-bottom:1px solid var(--border);padding:0 28px;height:64px;display:flex;align-items:center;justify-content:space-between;}
.topbar-left{display:flex;align-items:center;gap:16px;}
.back-btn{padding:8px 16px;background:var(--bg);border:1.5px solid var(--border);border-radius:8px;font-family:'Poppins',sans-serif;font-size:13px;font-weight:600;color:#666;cursor:pointer;}
.topbar-title{font-size:20px;font-weight:800;color:#2C1A0E;}
.page-body{padding:28px;}
.breadcrumb{display:flex;align-items:center;gap:8px;margin-bottom:24px;font-size:13px;color:#888;}
.breadcrumb a{color:var(--primary);font-weight:600;text-decoration:none;}

.form-layout{display:grid;grid-template-columns:1fr 320px;gap:24px;align-items:start;}
.form-card{background:#fff;border-radius:14px;border:1px solid var(--border);box-shadow:var(--shadow);overflow:hidden;margin-bottom:20px;}
.fc-header{padding:20px 24px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
.fc-header h3{font-size:15px;font-weight:700;color:#2C1A0E;}
.fc-header p{font-size:12px;color:#aaa;margin-top:2px;}
.fc-body{padding:24px;}
.form-group{margin-bottom:20px;}
.form-label{display:block;font-size:12px;font-weight:700;color:#4A3020;margin-bottom:7px;text-transform:uppercase;letter-spacing:.4px;}
.form-control{width:100%;padding:11px 14px;border:2px solid var(--border);border-radius:9px;font-family:'Poppins',sans-serif;font-size:13.5px;outline:none;transition:border-color .2s;background:#fafafa;}
.form-control:focus{border-color:var(--primary);background:#fff;box-shadow:0 0 0 3px rgba(111,78,55,.08);}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;}

/* Editable alert */
.edit-alert{display:flex;align-items:center;gap:10px;padding:12px 16px;background:#FFF8F0;border-radius:9px;border-left:3px solid var(--secondary);margin-bottom:20px;}
.edit-alert p{font-size:12.5px;color:#856404;font-weight:500;}

/* Activity log */
.activity-log{}
.log-item{display:flex;align-items:flex-start;gap:12px;padding:12px 0;border-bottom:1px solid var(--border);}
.log-item:last-child{border-bottom:none;}
.log-dot{width:10px;height:10px;border-radius:50%;margin-top:4px;flex-shrink:0;}
.log-text{font-size:12.5px;color:#444;line-height:1.5;}
.log-time{font-size:11px;color:#bbb;margin-top:2px;}

/* Danger zone */
.danger-zone{background:#FFF5F5;border:1px solid #FFCDD2;border-radius:14px;padding:20px 24px;}
.dz-title{font-size:14px;font-weight:700;color:#DC3545;margin-bottom:12px;}
.dz-row{display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid #FFCDD2;}
.dz-row:last-child{border-bottom:none;}
.dz-label{font-size:13px;font-weight:600;color:#444;}
.dz-sub{font-size:11.5px;color:#888;margin-top:2px;}
.btn-danger{padding:8px 18px;background:#DC3545;color:#fff;border:none;border-radius:8px;font-family:'Poppins',sans-serif;font-size:12px;font-weight:700;cursor:pointer;}
.btn-warn{padding:8px 18px;background:#FFC107;color:#000;border:none;border-radius:8px;font-family:'Poppins',sans-serif;font-size:12px;font-weight:700;cursor:pointer;}

/* Stat chips */
.stat-chips{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:16px;}
.stat-chip{background:var(--bg);border-radius:10px;padding:12px;text-align:center;}
.sc-val{font-size:22px;font-weight:800;color:#2C1A0E;}
.sc-label{font-size:11px;color:#aaa;}

.profile-preview-card{background:#fff;border-radius:14px;border:1px solid var(--border);box-shadow:var(--shadow);overflow:hidden;margin-bottom:20px;position:sticky;top:20px;}
.pp-header{padding:16px 20px;border-bottom:1px solid var(--border);}
.pp-header h4{font-size:14px;font-weight:700;color:#2C1A0E;}
.pp-body{padding:24px;text-align:center;}
.pp-avatar{width:72px;height:72px;border-radius:50%;background:linear-gradient(135deg,var(--primary),var(--secondary));display:flex;align-items:center;justify-content:center;font-size:26px;font-weight:800;color:#fff;margin:0 auto 12px;}
.pp-name{font-size:16px;font-weight:800;color:#2C1A0E;}
.pp-email{font-size:12px;color:#aaa;margin-top:3px;}
.pp-tags{display:flex;justify-content:center;gap:6px;margin-top:10px;}
.pp-tag{padding:4px 12px;border-radius:20px;font-size:11.5px;font-weight:700;}
.tag-employee{background:rgba(23,162,184,.1);color:#17A2B8;}
.tag-active{background:#D4EDDA;color:#155724;}

.btn-save{width:100%;padding:13px;background:linear-gradient(135deg,var(--primary),#8B6347);color:#fff;border:none;border-radius:9px;font-family:'Poppins',sans-serif;font-size:14px;font-weight:700;cursor:pointer;box-shadow:0 4px 16px rgba(111,78,55,.25);margin-bottom:10px;}
.btn-cancel{width:100%;padding:11px;background:#fff;color:#888;border:1.5px solid var(--border);border-radius:9px;font-family:'Poppins',sans-serif;font-size:13px;font-weight:600;cursor:pointer;}
.error {
    color: #dc3545;
    font-size: 12px;
    margin-top: 5px;
}
</style>
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