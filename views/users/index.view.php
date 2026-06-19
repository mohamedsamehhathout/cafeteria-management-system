<?php

$pageTitle = 'Users Management';

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');
?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <main class="page-body">
        <div class="page-header">

            <h1 class="page-title">
                 Manage Users
            </h1>

            <a href="/users/create" class="btn btn-primary">
                + Add New User
            </a>

        </div>

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

                                <div class="prod-cell">

                                    <img
                                        src="<?= htmlspecialchars(
                                                $this_user['image'] ?? '/images/default-product.png',
                                                ENT_QUOTES
                                            ) ?>"
                                        alt="Product Photo"
                                        class="prod-thumb">

                                    <div>

                                        <div class="prod-cell-name">

                                            <?= htmlspecialchars($this_user['name'] ?? '', ENT_QUOTES) ?>

                                        </div>

                                        <div class="prod-cell-desc">

                                            <?= htmlspecialchars($this_user['description'] ?? '', ENT_QUOTES) ?>

                                        </div>

                                    </div>

                                </div>

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

                            <form method="POST" action="/users" onsubmit="return confirm('Are you sure you want to delete this user?')">

                                <input type="hidden" name="_method" value="DELETE">

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= $this_user['id'] ?>"
                                >

                                <button type="submit" class="btn-del">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>
            

        </div>


    </main>
    

</div>

<?php require base_path('views/partials/footer.php'); ?>