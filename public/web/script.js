document.addEventListener("DOMContentLoaded", () => {
    const yearSpan = document.getElementById("year");
    yearSpan.textContent = new Date().getFullYear();
});

/* Navbar.html */
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('[data-collapse-toggle]');
    const navbarMenu = document.getElementById('navbar-sticky');
    const dropdownToggle = document.getElementById('dropdownNavbarLink');
    const dropdownMenu = document.getElementById('dropdownNavbar');

    menuToggle.addEventListener('click', function () {
        navbarMenu.classList.toggle('hidden');
    });

    dropdownToggle.addEventListener('click', function () {
        dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function (event) {
        if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
});

window.addEventListener('load', function() {
    const loading = document.getElementById('loading');
    const content = document.getElementById('content');

    // Hide loading spinner and show content
    loading.style.display = 'none';
    content.classList.remove('hidden');
});
