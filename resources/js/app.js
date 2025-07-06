import './bootstrap';
import * as bootstrap from 'bootstrap';
import 'flowbite';
// import Alpine from 'alpinejs';
document.addEventListener("DOMContentLoaded", () => {
    let lastScroll = 0;
    const navbar = document.getElementById("navbar");

    if (navbar) {
        window.addEventListener("scroll", () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll > lastScroll) {
                navbar.classList.add("-translate-y-full");
            } else {
                navbar.classList.remove("-translate-y-full");
            }

            lastScroll = currentScroll <= 0 ? 0 : currentScroll;
        });
    }
});
