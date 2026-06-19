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
    sidebar.classList.toggle("collapsed");

    main.classList.toggle("expanded");

    localStorage.setItem(
        "sidebarCollapsed",
        sidebar.classList.contains("collapsed"),
    );
});

if (localStorage.getItem("sidebarCollapsed") === "true") {
    sidebar.classList.add("collapsed");

    main.classList.add("expanded");
}
</script>