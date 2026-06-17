<?php

use Core\Auth;

$user = Auth::user();
?>
<!-- views/partials/navbar.php -->

<header class="topbar">
    
    <div>
        <div class="topbar-title">
            <?= $pageTitle ?? 'Dashboard'; ?>
        </div>

        <div class="topbar-sub">
            Welcome back,
            <?= htmlspecialchars($user['name'] ?? 'Guest') ?>
        </div>
        
    </div>

    <button id="sidebar-toggle" class="sidebar-toggle">
        ☰
    </button>

</header>