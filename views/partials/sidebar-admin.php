<?php

use Core\Auth;

$user = Auth::user();
?>
<aside class="sidebar">
    <div class="sidebar-logo">
        <span class="logo-icon">☕</span>

        <div class="logo-name">
            CaféDesk
        </div>

        <div class="logo-sub">
            Management
        </div>
    </div>

    <nav class="sidebar-nav">

        <div class="nav-section-label">
            Overview
        </div>

        <a href="/dashboard" class="<?= urlIS("/dashboard") ? "active" : "" ?>">
            <span class="nav-icon">📊</span>
            Dashboard
        </a>

        <div class="nav-section-label">
            Catalog
        </div>

        <a href="/products" class="<?= urlIS("/products") ? "active" : "" ?>">
            <span class="nav-icon">🍽️</span>
            Products
        </a>

        <a href="/categories" class="<?= urlIS("/categories") ? "active" : "" ?>">
            <span class="nav-icon">📁</span>
            Categories
        </a>

        <div class="nav-section-label">
            Orders
        </div>

        <a href="/orders" class="<?= urlIS("/orders") ? "active" : "" ?>">
            <span class="nav-icon">⚡</span>
            Orders
        </a>

        <a href="/reports" class="<?= urlIS("/reports") ? "active" : "" ?>">
            <span class="nav-icon">📈</span>
            Reports
        </a>

        <div class="nav-section-label">
            Users
        </div>

        <a href="/users" class="<?= urlIS("/users") ? "active" : "" ?>">
            <span class="nav-icon">👥</span>
            Users
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