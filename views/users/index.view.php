<?php

$pageTitle = 'Users Management';

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
.nav-link{display:flex;align-items:center;gap:11px;padding:10px 20px;color:rgba(255,255,255,.6);text-decoration:none;font-size:13px;font-weight:500;border-left:3px solid transparent;transition:all .2s;}
.nav-link:hover{color:#fff;background:rgba(255,255,255,.05);}
.nav-link.active{color:var(--secondary);background:rgba(217,160,102,.12);border-left-color:var(--secondary);}
.nav-section{font-size:10px;font-weight:600;letter-spacing:1.5px;color:rgba(255,255,255,.3);padding:12px 20px 4px;text-transform:uppercase;}
.sidebar-user{padding:14px 20px;border-top:1px solid rgba(255,255,255,.08);display:flex;align-items:center;gap:10px;margin-top:auto;}
.s-avatar{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#D9A066,#B8824A);display:flex;align-items:center;justify-content:center;font-weight:700;color:#fff;font-size:13px;}
.main{flex:1;display:flex;flex-direction:column;}
.topbar{background:#fff;border-bottom:1px solid var(--border);padding:0 28px;height:64px;display:flex;align-items:center;justify-content:space-between;}
.topbar-title{font-size:20px;font-weight:800;color:#2C1A0E;}
.page-body{padding:28px;}

/* Stats strip */
.user-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;}
.ustat{background:#fff;border-radius:12px;border:1px solid var(--border);padding:18px 20px;box-shadow:var(--shadow);display:flex;align-items:center;gap:14px;}
.ustat-icon{width:46px;height:46px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0;}
.ustat-label{font-size:11.5px;color:#aaa;font-weight:500;}
.ustat-val{font-size:24px;font-weight:800;color:#2C1A0E;line-height:1.1;}

/* Toolbar */
.toolbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;}
.toolbar-left{display:flex;align-items:center;gap:10px;}
.search-box{position:relative;}
.search-box input{padding:9px 14px 9px 36px;border:1.5px solid var(--border);border-radius:50px;font-family:'Poppins',sans-serif;font-size:13px;background:var(--bg);outline:none;width:260px;}
.search-box input:focus{border-color:var(--primary);background:#fff;}
.search-icon{position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:14px;color:#bbb;}
.filter-select{padding:9px 14px;border:1.5px solid var(--border);border-radius:8px;font-family:'Poppins',sans-serif;font-size:13px;background:#fff;outline:none;color:#444;}
.btn-add{padding:10px 10px;height: 8%;width:8%;margin:10px;background:var(--primary);color:#fff;border:none;border-radius:8px;font-family:'Poppins',sans-serif;font-size:13px;font-weight:700;cursor:pointer;}

/* Table */
.table-card{margin-top: 10px;width:100%;background:#fff;border-radius:14px;border:1px solid var(--border);box-shadow:var(--shadow);overflow:hidden;}
table{width:100%;border-collapse:collapse;}
thead th{background:#FAFAF8;padding:12px 20px;text-align:left;font-size:11px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:#bbb;border-bottom:2px solid var(--border);}
tbody td{padding:14px 20px;border-bottom:1px solid var(--border);font-size:13px;color:#444;vertical-align:middle;}
tbody tr:last-child td{border-bottom:none;}
tbody tr:hover td{background:#faf8f6;}

.user-cell{display:flex;align-items:center;gap:12px;}
.user-avatar{width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:#fff;font-size:14px;flex-shrink:0;}
.user-name{font-size:13.5px;font-weight:700;color:#2C1A0E;}
.user-email{font-size:11.5px;color:#aaa;}

.badge{display:inline-flex;padding:4px 12px;border-radius:20px;font-size:11.5px;font-weight:700;}
.badge-admin{background:rgba(111,78,55,.1);color:var(--primary);}
.badge-employee{background:rgba(23,162,184,.1);color:#17A2B8;}
.badge-active{background:#D4EDDA;color:#155724;}
.badge-inactive{background:#F8D7DA;color:#721C24;}

.action-btns{display:flex;gap:6px;}
.btn-edit{padding:6px 14px;margin: 0 5px;background:rgba(111,78,55,.08);color:var(--primary);border:1.5px solid rgba(111,78,55,.2);border-radius:6px;font-family:'Poppins',sans-serif;font-size:14px;font-weight:600;cursor:pointer;}
.btn-toggle-user{padding:6px 14px;background:rgba(40,167,69,.08);color:#28A745;border:1.5px solid rgba(40,167,69,.2);border-radius:6px;font-family:'Poppins',sans-serif;font-size:12px;font-weight:600;cursor:pointer;}
.btn-toggle-user.off{background:rgba(220,53,69,.08);color:#DC3545;border-color:rgba(220,53,69,.2);}
.btn-del{padding:6px 14px;margin-left: 5px;background:rgba(220,53,69,.08);color:#DC3545;border:1.5px solid rgba(220,53,69,.2);border-radius:6px;font-family:'Poppins',sans-serif;font-size:14px;font-weight:600;cursor:pointer;}

.pagination-row{display:flex;align-items:center;justify-content:space-between;padding:14px 24px;border-top:1px solid var(--border);}
.page-info{font-size:12px;color:#888;}
.page-btns{display:flex;gap:5px;}
.page-content{display: flex;text-align: center;justify-content: center;align-items: center;flex-direction: column;}
.page-btn{width:32px;height:32px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;cursor:pointer;border:1.5px solid var(--border);background:#fff;color:#666;}
.page-btn.active{background:var(--primary);border-color:var(--primary);color:#fff;}
.order{text-decoration: none; background:#FAFAF8;padding:12px 20px;text-align:left;font-size:11px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:#bbb;border-bottom:2px solid var(--border);}
</style>
<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <main class="page-content">

        

            

        

        <div class="table-card">

            <table>

                <thead>

                    <th>
                        <a class="order" href="/users?sort=name&direction=<?= ($sort === 'name' && $direction === 'asc') ? 'desc' : 'asc' ?>">
                            Name
                            <?php if($sort == 'name'): ?>
                            <?= $direction === 'asc' ? '↑' : '↓' ?>
                            <?php endif; ?>
                        </a>
                    </th>

                        <th>
                            <a class="order" href="/users?sort=email&direction=<?= ($sort === 'email' && $direction === 'asc') ? 'desc' : 'asc' ?>">
                            Email
                            <?php if($sort == 'email'): ?>
                            <?= $direction === 'asc' ? '↑' : '↓' ?>
                            <?php endif; ?>
                        </a>
                        </th>
                        <th>
                            <a class="order" href="/users?sort=role&direction=<?= ($sort === 'role' && $direction === 'asc') ? 'desc' : 'asc' ?>">
                            Role
                            <?php if($sort == 'role'): ?>
                            <?= $direction === 'asc' ? '↑' : '↓' ?>
                            <?php endif; ?>
                        </a>
                        </th>
                        <th>
                            <a class="order" href="/users?sort=room&direction=<?= ($sort === 'room' && $direction === 'asc') ? 'desc' : 'asc' ?>">
                            Room
                            <?php if($sort == 'room'): ?>
                            <?= $direction === 'asc' ? '↑' : '↓' ?>
                            <?php endif; ?>
                        </a>
                        </th>
                        <th>
                            <a class="order" href="/users?sort=extension&direction=<?= ($sort === 'extension' && $direction === 'asc') ? 'desc' : 'asc' ?>">
                            Extension
                            <?php if($sort == 'extension'): ?>
                            <?= $direction === 'asc' ? '↑' : '↓' ?>
                            <?php endif; ?>
                        </a>
                        </th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                <?php foreach ($users as $this_user) : ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars($this_user['name']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($this_user['email']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($this_user['role']) ?>
                        </td>

                        <td>
                            <?= $this_user['room_number'] ?? 'No Room' ?>
                        </td>

                        <td>
                            <?= $this_user['extension'] ?>
                        </td>

                        <td class="actions">

                            <a
                                href="/user?id=<?= $this_user['id'] ?>"
                                class="btn-view"
                            >
                                View
                            </a>

                            <a
                                href="/users/edit?id=<?= $this_user['id'] ?>"
                                class="btn-edit"
                            >
                                Edit
                            </a>

                            <form
                                method="POST"
                                action="/users"
                                style="display:inline-block;"
                                onsubmit="return confirm('Are you sure you want to delete this user?')"
                            >

                                <input
                                    type="hidden"
                                    name="_method"
                                    value="DELETE"
                                >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= $this_user['id'] ?>"
                                >

                                <button
                                    type="submit"
                                    class="btn-del"
                                    onsubmit="return confirm('Are you sure you want to delete this user?')"
                                >
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>
            

        </div>
        <a
                href="/users/create"
                class="btn-add"
                style="text-decoration: none;"
            >
                 Add User
            </a>

    </main>
    

</div>

<?php require base_path('views/partials/footer.php'); ?>