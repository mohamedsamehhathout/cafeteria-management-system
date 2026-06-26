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
<script>
const toggleBtn = document.getElementById("sidebar-toggle");
const sidebar = document.querySelector(".sidebar");
const main = document.querySelector(".main");

toggleBtn.addEventListener("click", () => {
    const isCollapsed = sidebar.classList.contains("collapsed");

    if (isCollapsed) {
        main.classList.remove("expanded");

        setTimeout(() => {
            sidebar.classList.remove("collapsed");
        }, 100);

    } else {

        sidebar.classList.add("collapsed");

        setTimeout(() => {
            main.classList.add("expanded");
        }, 100);
    }

    localStorage.setItem("sidebarCollapsed", !isCollapsed);
});

if (localStorage.getItem("sidebarCollapsed") === "true") {
    sidebar.classList.add("collapsed");
    main.classList.add("expanded");
}
</script>