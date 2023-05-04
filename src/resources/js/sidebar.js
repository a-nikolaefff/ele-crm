document.addEventListener("DOMContentLoaded", function (event) {
    const showNavbar = (pageId, sidebarId, headerId, toggleId) => {
        const page = document.getElementById(pageId),
            sidebar = document.getElementById(sidebarId),
            header = document.getElementById(headerId),
            toggle = document.getElementById(toggleId);
        // Validate that all variables exist
        if (toggle && sidebar && page && header) {
            toggle.addEventListener("click", () => {
                // show navbar
                sidebar.classList.toggle("sidebar_displayed");
                // change icon
                toggle.classList.toggle("bx-x");
                // add padding to body
                page.classList.toggle("page_menu-displayed");
                // add padding to header
                header.classList.toggle("header_menu-displayed");
            });
        }
    };

    showNavbar("page", "sidebar", "header", "header__toggle");

    const linkColor = document.querySelectorAll(".sidebar__link");
    function colorLink() {
        if (linkColor) {
            linkColor.forEach((l) => l.classList.remove("sidebar__link_active"));
            this.classList.add("sidebar__link_active");
        }
    }
    linkColor.forEach((l) => l.addEventListener("click", colorLink));
});
