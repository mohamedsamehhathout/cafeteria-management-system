<?php

echo "SIDEBAR WORKING";

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

        <a href="/">
            <span class="nav-icon">📊</span>
            Dashboard
        </a>

        <div class="nav-section-label">
            Catalog
        </div>

        <a href="/products">
            <span class="nav-icon">🍽️</span>
            Products
        </a>

        <a href="/categories">
            <span class="nav-icon">📁</span>
            Categories
        </a>

        <div class="nav-section-label">
            Orders
        </div>

        <a href="/orders">
            <span class="nav-icon">⚡</span>
            Orders
        </a>

        <a href="/reports">
            <span class="nav-icon">📈</span>
            Reports
        </a>

        <div class="nav-section-label">
            Users
        </div>

        <a href="/users">
            <span class="nav-icon">👥</span>
            Users
        </a>

        <div class="sidebar-bottom">
            <div class="nav-section-label">
                Account
            </div>

            <a href="/profile">
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
            AD
        </div>

        <div class="user-info">
            <div class="name">
                Admin User
            </div>

            <div class="role">
                Administrator
            </div>
        </div>

    </div>

</aside>