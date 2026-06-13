<?php

use Core\Auth;
use Core\Router;

$user = Auth::user();
?>
<aside class="sidebar">

    <div class="sidebar-logo">
        <span class="logo-icon">☕</span>

        <div class="logo-name">
            CaféDesk
        </div>

        <div class="logo-sub">
            Cafeteria
        </div>
    </div>

    <nav class="sidebar-nav">

        <div class="nav-section-label">
            Main
        </div>

        <a href="/home" class="<?= urlIS("/home") ? "active" : "" ?>">
            <span class="nav-icon">🏠</span>
            Home
        </a>

        <div class="nav-section-label">
            Orders
        </div>

        <a href="/my-orders" class="<?= urlIS("/my-orders") ? "active" : "" ?>">
            <span class="nav-icon">📦</span>
            My Orders
        </a>
        <div class="sidebar-bottom">
            <div class="nav-section-label">
                Account
            </div>

            <a href="/profile" class="<?= urlIS("/profile") ? "active" : "" ?>">
                <span class="nav-icon">👤</span>
                Profile
            </a>

            <form method="POST" action="/logout">

                <button type="submit" class="sidebar-link logout-link">

                    <span class="nav-icon">🚪</span>

                    Logout

                </button>

            </form>
        </div>
    </nav>

    <div class="sidebar-user">

        <div class="avatar">

            <?=
                strtoupper(
                    substr($user['name'], 0, 1)
                );
            ?>

        </div>

        <div class="user-info">
            <div class="name">
                <?= htmlspecialchars($user['name']) ?>
            </div>

            <div class="role">
                <?= $user['role'] === 'admin'
                ? 'Administrator'
                : 'Employee'; ?>
            </div>
        </div>

    </div>

</aside>