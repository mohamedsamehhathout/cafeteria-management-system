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